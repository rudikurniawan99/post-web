@extends('layouts.dashboard')

@section('content')
  <div class="card py-4">
    <div class="row container">
      <div class="col-12 col-md-6">
        <form action="{{ route('category.update', $category->id) }}" method="post">
          @method('put')
          @csrf
          <div class="form-group">
            <label for="title">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') ?? $category->name }}">
            @error('name')
              <p class="text-danger">{{ $message }}</p>
            @enderror
          </div>
          <button type="submit" class="btn btn-primary btn-block">Simpan</button>
        </form>
      </div>
    </div>
  </div>
@endsection