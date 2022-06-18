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
        </div>
        <div class="card-body">
            <div class="modal-body">
                <form action="{{ route('book.update',$books->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label for="book_name">Book Name</label>
                      <input type="text" class="form-control" id="book_name" name="book_name" value="{{ $books->book_name }}">
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
                      <input type="file" class="form-control" id="image" name="image" value="{{ $books->image }}">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="description" cols="30" rows="10">{{ $books->description }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
