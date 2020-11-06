@extends('layouts.dashboard')

@section('content')
  <div class="container">
    <div class="card border-0 p-4">
      <div class="row">
        @foreach ($posts as $post)
          <div class="col-12 col-md-6 mb-md-5">
            <div class="">
              <img style=" object-fit: contain; object-position: center;" class="w-100 rounded-lg" src="{{ Storage::url($post->image) }}" alt="">
            </div>
          </div>
          <div class="col-12 col-md-6 mt-5 mt-md-0 mb-5 mb-md-5">
            <div class="d-flex justify-content-between align-items-center">
              <div class="badge-secondary rounded-sm px-2 py-0">
                <small>{{ $post->category->name }}</small>
              </div>
              <p><small>{{ $post->created_at->format('d F Y') }}</small></p>
            </div>
            <h4 class="mb-3">Deskripsi</h4>
            <h6 class="font-weight-bold">{{ Str::title($post->title) }}</h6>
            <p class="text-black-50">{{ $post->body }}</p>
          </div>
        @endforeach 
      </div>
    </div>
  </div>
@endsection