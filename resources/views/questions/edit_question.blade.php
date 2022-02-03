@extends('layouts.app')
@section('title' , 'Edit Question')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background-color:#bbb9b9; margin-top: 10%;"  >
                <b class="card-header " style="font-weight: bold">{{ __('Type Question') }}</b>
                
                    <form action=" {{route('question.update' ,$question->id)}} " method="post">
                        @csrf
                        @method('PUT')
                    <div class="card-body">
                        <textarea class="form-control" name="title" placeholder="Please Type Question" >
                            {{old('title',$question->title)}}
                        </textarea>
    
                        
                        <b> Tags </b>
                        @forelse ($tags as  $tag)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"
                                value="{{$tag->id}}" name="name[]"  id="{{$tag->id}}" 
                                @if (in_array($tag->id , $question_tag)) checked @endif >
                            <label class="form-check-label" for="{{$tag->id}}">
                                {{$tag->name}}
                            </label>
                        </div>  
                        @empty
                        <p class="text-center text-danger">
                            {{'There Are No Tags ?'}}
                            </p>
                    @endforelse
                        <div class="d-grid gap-2 col-2 mx-auto">
                        <button class="btn btn-primary" type="submit">Send</button>
                        </div>
                    </div>
                    </form>
                </div>




            {{-- <div class="card"  style="background-color:#bbb9b9">
                <form action=" {{route('question.update' ,$question->id)}} " method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for=""> {{'Question'}} </label>
                        <textarea class="form-control" name="title" placeholder="Please Type Question" rows="3">
                            {{old('title',$question->title)}}
                        </textarea>
                    </div>
                    <label for=""> Tags </label>
                    @forelse ($tags as  $tag)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"
                                value="{{$tag->id}}" name="name[]"  id="{{$tag->id}}" 
                                @if (in_array($tag->id , $question_tag)) checked @endif >
                            <label class="form-check-label" for="{{$tag->id}}">
                                {{$tag->name}}
                            </label>
                        </div>  
                        @empty

                    @endforelse
                
                <div class="d-grid gap-2 col-2 mx-auto">
                <button class="btn btn-primary" type="submit">Update</button>
                </div>
            </form>
        </div> --}}
    </div>
    </div>
</div>
@endsection