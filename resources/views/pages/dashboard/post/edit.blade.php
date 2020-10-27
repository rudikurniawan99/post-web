@extends('layouts.dashboard')

@section('content')
  <div class="card py-4">
    <div class="row container">
      <div class="col-12 col-md-6">
        <form action="{{ route('post.update') }}" enctype="multipart/form-data" method="post">
          @method('put')
          @csrf
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control">
          </div>
          <div class="form-group">
            <label for="body">Body</label>
            <textarea name="body" id="body" class="form-control w-100"></textarea>
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