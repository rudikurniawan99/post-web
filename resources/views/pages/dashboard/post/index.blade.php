@extends('layouts.dashboard')

@section('content')
  <div class="card my-4 p-3 ">
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
      <table class="table table-striped text-center" id="yajra-table">
        <thead>
          <tr>
            <th>No</th>
            <th>Title</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($posts as $post)
            <tr>
              <td>{{ $loop->index+1 }}</td>
              <td>{{ $post->title }}</td>
              <td>
                <div class="d-flex justify-content-center">
                  <a href="{{ route('post.show', $post->id) }}" class="btn btn-sm btn-success mr-2">
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