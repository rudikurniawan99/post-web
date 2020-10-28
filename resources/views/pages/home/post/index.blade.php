@extends('layouts.app', ['title' => 'Post List'])

@section('content')
  <div class="container">
    <div class="row">
      @foreach ($posts as $post)
        <div class="col-12 col-md-4 mb-5">
          <div  class="card border-0 rounded-lg">
            <div class="card-body shadow">
              {{-- <img style="height: 200px; object-fit: cover; object-position: center" src="{{ Storage::url($post->image) }}" alt="">  --}}
              <h5 class="my-2 font-weight-bold">{{ $post->title }}</h5>
              <p class="text-black-50">{{ Str::limit($post->body, 150, '...') }}
                <span>
                  <a href="{{ route('post.show', $post->id) }}" class="d-inline ml-1 font-weight-bolder">Readmore</a>
                </span>
              </p>
              <p class="text-right text-black-50 font-weight-light">Published On <span class="font-weight-bold">{{ $post->created_at->format('M, d Y') }}</span> </p> 
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