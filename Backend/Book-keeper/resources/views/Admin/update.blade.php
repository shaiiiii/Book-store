@extends('Admin.layouts.dashboard')

@section('content')
<div class="card p-3">
    <div class="card-header mb-4">Update Book Details</div>

    <div class="row">
        <div class="col-md-6 d-flex justify-content-center align-items-center mb-2 flex-column">
            <h2>Edit Book</h2>
            <form action="{{ route('Admin.books.update', $book->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-2">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}" required>
                </div>

                <div class="form-group mb-2">
                    <label for="author">Author</label>
                    <input type="text" class="form-control" id="author" name="author" value="{{ $book->author }}" required>
                </div>

                <div class="form-group mb-2">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="price" step="0.01" value="{{ $book->price }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="stock">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" value="{{ $book->stock }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Update Book</button>
            </form>
        </div>

        <div class="col-md-6">
            <img src="{{ asset('images/createbg.jpg') }}" alt="Background Image" class="img-fluid" style="height: 100%; max-height:500px">
        </div>
    </div>
</div>
@endsection
