

@extends('member.layouts.dashboard')

@section('content')
    <div class="card p-3">
        <div class="card-header mb-4">Your Book records</div>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Book Title</th>
                    <th>Issued Date</th>
                    <th>Received Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookIssuances as $issuance)
                    <tr>
                        <td>{{ $issuance->id }}</td>
                        <td>{{ $issuance->book->title }}</td>
                        <td>{{ $issuance->issued_date }}</td>
                        <td>{{ $issuance->received_date ?? 'Not Received' }}</td>
                        <td>{{ $issuance->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
