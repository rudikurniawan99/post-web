@extends('layouts.dashboard')

@section('content')
  <div class="container">
    <div class="card border-0 p-4">
      <div class="row">
        {{-- @foreach ($posts as $post) --}}
          <div class="col-12 col-md-6 mb-md-5">
            <div class="">
              <img style="height: 80vh; object-fit: cover; object-position: bottom;" class="w-100 rounded-lg" src="{{ Storage::url($post->image) }}" alt="">
            </div>
          </div>
          <div class="col-12 col-md-6 mt-5 mt-md-0 mb-5 mb-md-5">
            <h4 class="mb-5">Deskripsi</h4>
            <h6 class="font-weight-bold">{{ $post->title }}</h6>
            <p class="text-black-50">{{ $post->body }}</p>
          </div>
        {{-- @endforeach  --}}
      </div>
    </div>
  </div>
@endsection