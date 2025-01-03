@extends('Admin.layouts.dashboard')

@section('content')
<div class="card p-3">
    <div class="card-header mb-4">Issue a Book</div>

    <div class="row">
        <div class="col-md-6 d-flex justify-content-center align-items-center mb-2 flex-column">
            <h2>Issue a Book</h2>
            <form action="{{ route('book-issuances.store') }}" method="POST">
                @csrf

                <div class="form-group mb-2">
                    <label for="book_id">Book</label>
                    <select class="form-control" id="book_id" name="book_id" required>
                        @foreach ($books as $book)
                            <option value="{{ $book->id }}">{{ $book->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-2">
                    <label for="user_id">User</label>
                    <select class="form-control" id="user_id" name="user_id" required>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-2">
                    <label for="issued_date">Issued Date</label>
                    <input type="date" class="form-control" id="issued_date" name="issued_date" required>
                </div>



                <button type="submit" class="btn btn-primary">Issue Book</button>
            </form>
        </div>

        <div class="col-md-6">
            <img src="{{ asset('images/createbg.jpg') }}" alt="Background Image" class="img-fluid" style="height: 100%;max-height:500px">

        </div>
    </div>
</div>
@endsection
