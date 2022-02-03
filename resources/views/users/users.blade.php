@extends('layouts.app')

@section('title' , 'All Users')
@section('content')

  <div class="container">
    <div class="row">
      <h1 class="text-center" style="margin-top: 50px">
        Show All Users And Profile
      </h1>
<hr>
      @foreach ($users as $user)
        <div class="col-md-3">
          <p>
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample"
              aria-expanded="false" aria-controls="collapseWidthExample">
              {{$user->name}}
            </button>
          </p>
          <div style="min-height: 120px;">
            <div class="collapse collapse-horizontal" id="collapseWidthExample">
              <div class="card card-body" style="width: 300px;">

                <p style="font-weight: bold">Email ::
                  <span class="badge bg-dark">
                    {{$user->email}}
                  </span>
                </p>

                <p style="font-weight: bold">Phone ::
                  <span class="badge bg-dark">{{$user->profile->mobile}}</span>
                </p>

                <p style="font-weight: bold">Gander ::
                  <span class="badge bg-dark">{{$user->profile->gander}}</span>
                </p>

                <p style="font-weight: bold">Birthday ::
                  <span class="badge bg-dark">{{$user->profile->birthday}}</span>
                </p>

                <p style="font-weight: bold">Birthday ::
                  <span class="badge bg-dark">{{$user->profile->created_at->diffForHumans()}}</span>
                </p>
              </div>
            </div>
          </div>
      </div>
    @endforeach
  </div>
</div>
@endsection