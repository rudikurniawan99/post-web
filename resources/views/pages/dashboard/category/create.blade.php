@extends('layouts.dashboard', ['title' => 'Create Category'])

@section('content')
  <div class="card py-4">
    <div class="row container">
      <div class="col-12 col-md-6">
        <form action="{{ route('category.store') }}" method="post">
          @csrf
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control">
            @error('name')
              <div class="text-danger mt-1">
                <p class="font-weight-light">{{ $message }}</p>
              </div>
            @enderror
          </div>
          <button type="submit" class="btn btn-primary btn-block">Simpan</button>
        </form>
      </div>
    </div>
  </div>
@endsection