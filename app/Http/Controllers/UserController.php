<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('profile')->latest()->paginate(5);
        return view('welcome' ,compact('users'));
    }
    public function profile()
    {
        $user = User::findOrfail(Auth::id());
        $questions = Question::where('user_id' , Auth::id())->withCount('answers')->latest()->paginate(10);
        
        return view('users.profile' ,compact('user' , 'questions'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'      => ['required' , 'string' , 'min:5' , 'max:15'],
            'email'     => ['required' , 'string' , 'email' ],
            // 'mobile'    => ['string'   , 'min:10' , 'max:25'],
            // 'birthday'  => ['nullable' ,'date'     , 'before:today' ],
            'avatar'    => ['image'    , 'dimensions:min_width=200px , min_height=200px' , 'max:512000'],
        ]);
        // $request->merge([
            
        //     'user_id' => Auth::id(),
        // ]);
        // dd($request->all());
        $user = User::find(Auth::id());

            if(!is_null($request->input('old_password') )){
                $request->validate([
                    'old_password'=> 'string|min:5|max:30',
                    'new_password'=> 'required|string|min:5|max:30'
                ]);

                if(Hash::check($request->old_password , $user->password)){
                    $user->password = Hash::make($request->new_password);
                    $user->save();
                    Auth::logout();
                    Toastr::success('Successfully Changed Password');
                    return redirect()->route('login');
                
                }else{
                    Toastr::error('The Password Is Incorrect');
                    return redirect()->back();
            }
        }
            if($request->hasFile('avatar')){
                $path_photo = public_path('storage/users/'.$user->avatar);
                // Delete the image if it is present when editing
                if(File::exists($path_photo)){
                    File::delete($path_photo);
                }
                $name_photo = time() . '_' . $request->name .'.'. $request->avatar->extension();
                $upload_photo = $request->avatar->storeAs('users/' ,$name_photo , 'public');
                $user->avatar = $name_photo;
                $user->save();
                
            }
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);
        $user->profile()->updateOrCreate(
            ['user_id' => Auth::id()],
        [
            'mobile' => $request->input('mobile'),
            'gander' => $request->input('gander'),
            'birthday' => $request->input('birthday'),
        ]);
        Toastr::success('Successfully Updated Data');
        return redirect()->back();
    }
}
