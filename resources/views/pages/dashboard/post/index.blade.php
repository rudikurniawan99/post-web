@extends('layouts.dashboard')

@section('content')
  <div class="card my-4 p-3 ">
    @if (session()->has('success-add'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session()->get('success-add') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
    @elseif(session()->has('success-edit'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session()->get('success-edit') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
    @endif
    <div class="card-title">
      <div class="d-flex justify-content-between">
        <h4>Posts</h4>
        <a href="{{ route('post.create') }}" class="btn btn-primary btn-sm">
          <i class="fas fa-plus mr-2"></i>
          Tambahkan Post
        </a>
      </div>
    </div>
    <div class="card-body px-0">
      <table class="table table-striped" id="yajra-table">
        <thead>
          <tr>
            <th>No</th>
            <th>Title</th>
            <th>Category</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($posts as $post)
            <tr>
              <td>{{ $loop->index+1 }}</td>
              <td>{{ Str::title($post->title) }}</td>
              <td>{{ $post->category->name }}</td>
              <td>
                <div class="d-flex">
                  <a href="{{ route('post.show',[$post->category->slug, $post->slug]  ) }}" class="btn btn-sm btn-success mr-2">
                    <i class="fas fa-book"></i>
                  </a>
                  <a href="{{ route('post.edit',$post->id) }}" class="btn btn-info btn-sm mr-2">
                    <i class="fas fa-pen"></i>
                  </a>
                  <form action="{{ route('post.destroy',$post->id) }}" method="post">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger btn-sm">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  
@endsection

{{-- DataTables Failed --}}
{{-- @push('js')
  <script type="text/javascript">
    $(function(){

      var table = $('#yajra-table').DataTable({
        processing : true,
        serverSide : true,
        ajax: {{ route('post.index') }},
        columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          {data: 'title', name: 'title'},
          {
            data: 'id',
            name: 'id',
            searchable: false,
            sortable: false,
            render: function(data){
              const edit = `
              <a href="{{ route('post.index') }}/${data}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i>
              </a>`
              const destroy = `
              <form action="{{ route('post.index') }}/${data}" method="post">
                @method('delete')
                @csrf
                <button class="btn btn-sm btn-danger">
                  <i class="fas fa-trash"></i>
                </button>
              </form>`
              const buttons = `
              <div class="d-inline">
                ${edit},
                ${destroy}
              </div>`
              return buttons;
            }
          }
        ],
        pagingType : "numbers"
      });
    });
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
@endpush --}}