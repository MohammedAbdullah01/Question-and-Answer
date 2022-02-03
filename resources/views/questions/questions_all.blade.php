@extends('layouts.app')
@section('title' , 'Questions')
@section('content')

<h3 class="text-center text-light">Show All questions Users</h3><hr>
    <div class="container" >
        <div class="row">
            @forelse ($questions as $question)
                <div class="col-md-12" >
                    <div class="card" style="background-color:#bbb9b9">
                        <div class="card-body">
                            <span class="card-title">
                                {{$question->user->name . ' : ' .$question->created_at->diffForHumans()}}
                            </span> 
                        
                            <a href=" {{route('show.question', $question->id)}} ">
                                <h5 class="card-title" style="font-weight: bold">{{$question->title}}</h5>
                            </a>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <span class="badge bg-info">Answers :
                                    <span class="badge bg-light text-dark">{{$question->answers_count}}</span>
                                </span>
                            </div>
                            <hr>
                            <span class="badge rounded-pill bg-secondary">
                                {{implode(' , ' , $question->tags->pluck('name')->toArray())}}
                                @empty($question->tags->name)
                                There are no Tags !
                            @endempty
                            </span>
                            
                        </div>
                    </div>
                
                @empty
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading text-center"> There are no questions available ! </h4>
                </div>
            </div>
            @endforelse
        </div>
    </div>
    
{{ $questions->withQueryString()->links() }}
@endsection
    