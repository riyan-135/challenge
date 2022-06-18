@extends("admin.layout")
@section("title", "Dashboard")
@section("content-title", "Kost")
@section('css')
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
@endsection
@section("content")

<!-- DataTales Example -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        {{-- <h6 class="m-0 font-weight-bold text-primary">List Kost<span class="float-right"> <a href="{{ route('kost.create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus">Add Kost</i></a></span></h6> --}}
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Create Book
        </button>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{$message}}</p>
            </div>
        @endif
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Author Name</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $key => $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->book_name }}</td>
                                <td>{{ $item->created_book->name }}</td>
                                <td>
                                    <img src="{{ Storage::url($item->image) }}" width="100px">
                                </td>
                                <td>{{ $item->description }}</td>
                                <td>
                                    <a href="{{ route('book.show', $item->id) }}" class="btn btn-primary btn-sm">Show</a>
                                    <a href="{{ route('book.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('book.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="book_name">Book Name</label>
                  <input type="text" class="form-control" id="book_name" name="book_name">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Book Author</label>
                    <select class="form-control" id="author_id" name="author_id">
                        @foreach ($author as $item)
                            <option value="{{$item->id}}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                  </div>
                <div class="form-group">
                  <label for="image">Image</label>
                  <input type="file" class="form-control" id="image" name="image">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" id="description" cols="30" rows="10"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </form>
        </div>
      </div>
    </div>
  </div>
@endsection
