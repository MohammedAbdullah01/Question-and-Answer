@extends('layouts.app')
@section('title' , 'Show Question')
@section('content')

    <div class="container" > 
        <a href=" {{route('user.profile')}} " class="card-title" style="text-decoration: none" >
            {{$question->user->name}} :  
        </a>
            {{$question->created_at->diffForHumans()}}
        <h3 class="card-title" >
            {{$question->title}}
        </h3>
        @if ($question->user_id == auth()->id() )
            <a class="btn btn-success btn-sm" href="{{route('question.edit'  , $question->id)}} ">Edit</a>
            <form action=" {{route('question.delete' , $question->id)}}" method="post" style="display: contents;">
                @csrf
                @method("POST")
            <button class="btn btn-danger btn-sm"  type="submit">Delete</button>
            </form>
        @endif
        <ul class="nav justify-content-center" style="background-color:#bbb9b9; width: 40%; margin: auto" >
            @forelse ($question->tags as $tag)
                <li class="nav-item">
                <a class="nav-link" href="#">{{$tag->name}}</a>
                </li>
            @empty
                <span class="text-center text-danger">There is no tags !
                    {{-- <a href=" {{route('question.edit'  , $question->id)}}">Add Tags</a> --}}
                </span>
            @endforelse
            
        </ul>
        <div class="row">
            <div class="col-md-12"  >
                <div class="card" style="background-color:#bbb9b9">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <span class="badge bg-primary">Answers : {{$answers->count()}}</span>
                    </div>
                    <div class="card-body">
                            @forelse ($answers as $answer)
                                <h6 class="card-title">
                                    {{$answer->user->name. ' : ' .$answer->created_at->diffForHumans()}}
                                </h6>
                                <h5 class="card-title" style="font-weight: bold">
                                    {{$answer->title}}
                                </h5>
                                <form action=" {{route('question.best.answer' , $answer->id)}} " method="post">
                                    @csrf
                                    @method('PUT')
                                    @auth
                                    @if ($answer->best_answer == 1)
                                        <button class="badge rounded-pill bg-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                            </svg>
                                        </button>
                                    @else
                                        <button class="badge rounded-pill bg-light text-dark" type="submit" >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/></svg>
                                        </button>
                                    @endif
                                    @endauth
                                </form>
                                <hr size="8px">
                            @empty
                                <p class="text-danger text-center" style="font-weight: bold"> There are No Answers ? </p>
                            @endforelse
                            
                            
                        
                        @auth
                            <div class="col-md-12">
                                <form action="{{route('question.store.answer')}}" method="post">
                                    @csrf
                                    @method('POST')
                                    <div class="form-floating">
                                        <textarea class="form-control" name="title"  placeholder="Type Answer"
                                        id="floatingTextarea2" style="height: 100px">
                                        </textarea>
                                        <label for="#floatingTextarea2">Comments</label>
                                        @error('title')
                                            <span class="text-danger">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="d-grid gap-2 col-2 mx-auto">
                                        <button type="submit" class="btn btn-primary">Send</button>
                                    </div>
                                        <input  type="hidden" name="question_id" value="{{$question->id}}">
                                </form>
                            </div>
                        @endauth
                        @guest
                            <a href=" {{route('login')}} ">Login To Answer</a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection



