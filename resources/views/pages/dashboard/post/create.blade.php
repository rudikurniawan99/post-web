@extends('layouts.dashboard', ['title' => 'Create Post'])

@section('content')
  <div class="card py-4">
    <div class="row container">
      <div class="col-12 col-md-6">
        <form action="{{ route('post.store') }}" enctype="multipart/form-data" method="post">
          @csrf
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="">
            @error('title')
              <div class="text-danger mt-1">
                <p class="font-weight-light">{{ $message }}</p>
              </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="category_id">Category</label>
            <div class="d-flex">
              <select name="category_id" id="category_id" class="form-control">
                <option selected disabled>Choose category</option>
                @foreach ($categories as $ctg)
                  <option value="{{ $ctg->id }}">{{ Str::title($ctg->name) }}</option>
                @endforeach
              </select>  
              <a class="ml-3 btn btn-info" data-toggle="modal" data-target="#categoryModal">
                <i class="fas fa-plus"></i>
              </a>
            </div> 
          </div>

          
          <div class="form-group">
            <label for="body">Body</label>
            <textarea name="body" id="body" class="form-control w-100"></textarea>
            @error('body')
              <div class="text-danger mt-1">
                <p>{{ $message }}</p> 
              </div>
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

  {{-- Modal for create category --}}
  <!-- Button trigger modal -->
  <!-- Modal -->
  <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambahkan Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('category.store') }}" method="post">
          @csrf
          <div class="modal-body">
            <label for="name">Name</label>
            <input placeholder="Inputkan category" type="text" name="name" id="name" class="form-control">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection