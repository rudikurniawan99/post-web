@extends('layouts.dashboard')

@section('content')
  <div class="card py-4">
    <div class="row container">
      <div class="col-12 col-md-6">
        <form action="{{ route('post.update', $post->id) }}" enctype="multipart/form-data" method="post">
          @method('put')
          @csrf
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') ?? $post->title }}">
            @error('title')
              <p class="text-danger">{{ $message }}</p>
            @enderror
          </div>
          <div class="form-group">
            <label for="category_id">Category</label>
            <select class="form-control" name="category_id">
              <option disabled>Select Category</option>
              @foreach ($categories as $ctg)
                <option {{ $ctg->id == $post->category_id ? 'selected' : '' }} value="{{ $ctg->id }}">{{ Str::title($ctg->name) }}</option> 
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="body">Body</label>
            <textarea name="body" id="body" class="form-control w-100">{{ old('body') ?? $post->body }}</textarea>
            @error('body')
              <p class="text-danger">{{ $message }}</p>
            @enderror
          </div>
          <div class="form-group">
            <label for="image"></label>
            <input type="file" name="image" id="image">
          </div>
          <button type="submit" class="btn btn-primary btn-block">Simpan</button>
        </form>
      </div>
    </div>
  </div>
@endsection