@extends('Admin.layouts.dashboard')

@section('content')
<div class="container">
    <h2 style="text-align:center;" class="mb-5">Books Collection</h2>

    <!-- Add Book Button -->
    <div class="w-100 text-right mb-4">
        <a href="{{ route('Admin.books.create') }}" class="btn btn-primary">+ Add New Book</a>
    </div>

    <div class="container">
        <!-- Display Books as Cards -->
        <div class="row">
            @foreach ($books as $book)
            <div class="col-md-4 mb-4">
                <div class="card bookc shadow-sm h-100">
                    <!-- Display the Book Image -->
                    @if ($book->image)
                    <img src="{{ asset('storage/' . $book->image) }}" class="card-img-top rounded" alt="{{ $book->title }}" style="height: 250px; object-fit: cover;">
                    @else
                    <!-- Fallback if no image is uploaded -->
                    <img src="{{ asset('images/default-book.png') }}" class="card-img-top rounded" alt="Default Image" style="height: 250px; object-fit: cover;">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title font-weight-bold text-primary">{{ $book->title }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $book->author }}</h6>
                        <p class="card-text">Price: <span class="text-success">${{ $book->price }}</span></p>
                        <p class="card-text">Stock: <span class="text-dark">{{ $book->stock }}</span></p>
                        @if ($book->stock == 0)
                        <span class="badge badge-danger float-right">Out of Stock</span>
                        @endif
                        <hr>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('Admin.books.edit', $book->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('Admin.books.delete', $book->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
