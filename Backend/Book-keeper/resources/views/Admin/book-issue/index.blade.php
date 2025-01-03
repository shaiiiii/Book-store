@extends('Admin.layouts.dashboard')

@section('content')
<div class="card p-3">
    <div class="card-header mb-4">All Book Issuances</div>

    <div class="w-100 text-right" style="text-align: right;">
        <a href="{{ route('book-issuances.create') }}" class="btn btn-primary mb-3">Issue Book</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Book Title</th>
                <th>User Name</th>
                <th>Issued Date</th>
                <th>Received Date</th>
                <th>Status</th>
                <th>Action</th>
                <!-- Add more columns as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach ($bookIssuances as $issuance)
                <tr>
                    <td>{{ $issuance->id }}</td>
                    <td>{{ $issuance->book->title }}</td>
                    <td>{{ $issuance->user->name }}</td>
                    <td>{{ $issuance->issued_date }}</td>
                    <td>{{ $issuance->received_date ?? 'Not Received' }}</td>
                    <td>{{ $issuance->status }}</td>
                    <td>
                        @if ($issuance->status === 'issued')
                            <form action="{{ route('book-issuances.receive', $issuance->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success">Receive</button>
                            </form>
                        @else
                            <!-- Display a message or other action for received issuances -->
                            Received
                        @endif
                    </td>
                    <!-- Add more columns as needed -->
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
