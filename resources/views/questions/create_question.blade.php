@extends('layouts.app')
@section('title' , 'Add Question')
@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card" style="background-color:#bbb9b9; margin-top: 10%;"  >
            <b class="card-header " style="font-weight: bold">{{ __('Type Question') }}</b>
            
                <form action=" {{route('question.store')}} " method="post">
                  @csrf
                  @method('POST')
                  <div class="card-body">
                      <textarea class="form-control" name="title" placeholder="Please Type Question" >
                        {{old('title')}}
                      </textarea>

                    
                    <b> Tags </b>
                    @forelse ($tags as  $tag)
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{$tag->id}}" name="name[]" 
                        id="{{$tag->id}}">
                        <label class="form-check-label" for="{{$tag->id}}">
                          {{$tag->name}}
                        </label>
                      </div>  
                      @empty
                        
                    @endforelse
                    <div class="d-grid gap-2 col-2 mx-auto">
                      <button class="btn btn-primary" type="submit">Send</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
        </div>
      </div>
      
@endsection