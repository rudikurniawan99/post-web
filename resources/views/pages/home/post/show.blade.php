@extends('layouts.app')

@section('content')
  <div class="container p-5">
    <div class="card border-0 px-5">
      <div class="card-body">
        <h6 class="font-weight-bold">{{ $post->title }}</h6>
        <p class="text-black-50">{{ $post->body }}</p>
      </div>
    </div>
  </div>
@endsection