@extends('layouts.app', ['title' => 'Post List'])

@section('content')
  <div class="container">
    <div class="row">
      @foreach ($posts as $post)
        <div class="col-12">
          <div  class="card border-0 rounded-lg mb-5">
            <div class="card-body shadow">
              {{-- <img style="height: 200px; object-fit: cover; object-position: center" src="{{ Storage::url($post->image) }}" alt="">  --}}
              <a href="{{ route('home.post.show', $post->id) }}" style="text-decoration: none;">
                <h5 class="font-weight-bold" style="color: black;">{{ $post->title }}</h5>
              </a>
              <div class="d-flex justify-content-between">
                <a href="{{ route('home.post.category.show', $post->category->slug) }}">
                  <p class="badge badge-secondary">{{ $post->category->name }}</p>
                </a>
                <p class="text-black-50"><small>{{ $post->created_at->format('d, F Y') }}</small></p>
              </div>
              <p class="text-black-50">{{ Str::of($post->body)->padLeft(10)->limit(150, '...')  }}
                @if (Str::length($post->body) >= 150)
                  <span>
                    <a href="{{ route('home.post.show', $post->id) }}" class="d-inline ml-1 font-weight-bolder">Readmore</a>
                  </span>
                @endif 
              </p>
              {{-- <p class="text-right text-black-50 font-weight-light">Published On <span class="font-weight-bold">{{ $post->created_at->format('M, d Y') }}</span> </p>  --}}
              {{-- Result : normal -> look doc in php date format --}}

              {{-- <p class="text-right text-black-50 font-weight-light">Published On <span class="font-weight-bold">{{ $post->created_at->diffForHumans() }}</span> </p>  --}}
              {{-- Result : 1 minutes ago --}}
            </div>
          </div>
        </div>      
      @endforeach
      <div class="d-flex justify-content-center">
        {{ $posts->links('vendor.pagination.bootstrap-4') }}
      </div>

    </div>   
  </div> 
@endsection

