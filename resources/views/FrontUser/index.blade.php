@extends("FrontUser.layout")
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
        {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Create User
        </button> --}}
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
                        @foreach ($book as $key => $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->book_name }}</td>
                                <td>{{ $item->created_book->name }}</td>
                                <td>
                                    <img src="{{ Storage::url($item->image) }}" width="100px">
                                </td>
                                <td>{{ $item->description }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
