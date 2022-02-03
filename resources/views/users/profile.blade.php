@extends('layouts.app')

@section('title' , 'Profile')

@section('content')
<div class="container">
    <h1 class="text-center">
        {{'My Profile'}}
    </h1>
    <hr>
    <div class="row">
        <div class="col-md-6" >
            <form action=" {{route('user.update')}} " method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="input-group mb-3" >
                    <span class="input-group-text">Name</span>
                    <input type="text" class="form-control @error('name') is-invalid @enderror " placeholder="Username" name="name" value="{{old('name',$user->name)}}">
                    @error('name')
                        <p class="invalid-feedback">
                            {{$message}}
                        </p>
                    @enderror
                </div>
                
                <div class="input-group mb-3">
                    <span class="input-group-text">E-mail</span>
                    <input type="email" class="form-control @error('email') is-invalid @enderror " placeholder="Email" name="email" value="{{old('email',$user->email)}}">
                    @error('email')
                        <p class="invalid-feedback">
                            {{$message}}
                        </p>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Old Password</span>
                    <input type="password" class="form-control" placeholder="Type Old Password" name="old_password">
                    @error('old_password')
                        <p class="invalid-feedback">
                            {{$message}}
                        </p>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">New Password</span>
                    <input type="password" class="form-control @error('new_password') is-invalid @enderror " placeholder="Type New Password Strong" name="new_password">
                    @error('new_password')
                        <p class="invalid-feedback">
                            {{$message}}
                        </p>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Phone</span>
                    <input type="text" class="form-control  @error('mobile') is-invalid @enderror" placeholder="Number Phone" name="mobile" value="{{old('mobile',$user->profile->mobile)}}" >
                    @error('mobile')
                        <p class="invalid-feedback">
                            {{$message}}
                        </p>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Gander</span>
                    <select class="form-select @error('gander') is-invalid @enderror" name="gander" value="{{old('gander',$user->profile->gander)}}">
                        <option value="" selected>Choess select menu</option>
                        <option value="male"   {{$user->profile->gander ==  'male'   ?  'selected' : ''}}>Male</option>
                        <option value="female" {{$user->profile->gander ==  'female' ?  'selected' : ''}}>Female</option>
                    </select>
                    @error('gander')
                        <p class="invalid-feedback">
                            {{$message}}
                        </p>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">BirthDay</span>
                    <input type="date" class="form-control @error('birthday') is-invalid @enderror"  name="birthday" value="{{old('birthday',$user->profile->birthday)}}">
                    @error('birthday')
                        <p class="invalid-feedback">
                            {{$message}}
                        </p>
                    @enderror
                </div>
                
                <div class="input-group mb-3">
                    <span class="input-group-text">Avatar</span>
                    <input type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" >
                        @error('avatar')
                            <p class="invalid-feedback">
                                {{$message}}
                            </p>
                        @enderror
                </div>
                <div class="d-grid gap-2 col-2 mx-auto">
                    <button class="btn btn-primary" type="submit">Edit</button>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <div class="card" style="background-color: #6c757d" >
                @if ($user->avatar == 'avatar.png')
                <img src="{{asset('storage/defualt/'.$user->avatar)}}" alt="..." 
                style="border-radius: 50%; margin: auto; margin-top: 30px;" width="100px" height="100px">
                @else
                <img src="{{asset('storage/users/'.$user->avatar)}}" alt="..." 
                style="border-radius: 50%; margin: auto; margin-top: 30px;" width="100px" height="100px">
                @endif
                
                <div class="card-body">
                    <h3 class="card-title text-center">
                        {{$user->name}} 
                    </h3>
                </div>
                <ul class="list-group ">
                    <span class="badge bg-secondary">E-mail</span>
                    <li class="list-group-item">{{$user->email}}</li>
                    
                    <span class="badge bg-secondary">Phone</span>
                    <li class="list-group-item">{{$user->profile->mobile}}</li>
                    
                    <span class="badge bg-secondary">Gander</span>
                    <li class="list-group-item">{{$user->profile->gander}}</li>
                    
                    <span class="badge bg-secondary">Birthday</span>
                    <li class="list-group-item">{{$user->profile->birthday}}</li>
                </ul>
            </div>
        </div>
        <div class="col-md-12">
            <h1 class="text-center">
                {{' My Questions'}}
            </h1><hr>
            @forelse ($questions as $question)
                <div class="card" style="background-color:#bbb9b9">
                    <div class="card-body">
                        <span class="card-title">
                            {{$question->created_at->diffForHumans()}}
                        </span> 
                    
                        <a href=" {{route('show.question', $question->id)}}">
                            <h5 class="card-title" style="font-weight: bold">{{$question->title}}</h5>
                        </a>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <span class="badge bg-info">Answers :
                                <span class="badge bg-light text-dark">{{$question->answers_count}}</span>
                            </span>
                        </div>
                        <span class="badge rounded-pill bg-secondary">
                            {{implode(' , ' , $question->tags->pluck('name')->toArray())}}
                            @empty($question->tags->name)
                            There are no Tags !
                        @endempty
                        </span>
                        <h1>
                        <hr>
                    </div>
                </div>
                <br>
            @empty
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading text-center"> There are no questions available ! </h4>
            </div>
        @endforelse
    </div>

    </div>
</div>
    {{ $questions->links() }}
@endsection