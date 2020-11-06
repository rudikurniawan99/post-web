@extends('layouts.app')

@section('content')
  <div class="container p-5">
    <div class="card border-0 px-5">
      <div class="card-header bg-transparent">
        <h1>Kategori : {{ Str::title($category->name) }}</h1>
      </div>
      <div class="card-body mt-3">
        <div class="row">
          @foreach ($posts as $post)
            <div class="col-12 mb-3">
              <div class="d-flex justify-content-between">
                <h4>{{ $post->title }}</h4>
                <p><small>{{ $post->created_at->diffForHumans() }}</small></p>
              </div>
              <p class="text-black-50">{{ Str::padLeft($post->body, 10) }}</p>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
@endsection