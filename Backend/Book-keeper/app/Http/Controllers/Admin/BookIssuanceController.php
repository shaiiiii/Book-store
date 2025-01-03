<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\BookIssuance;


class BookIssuanceController extends Controller
{

    // List all book issuances
    public function index($userId)
    {

        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.'
            ], 404);
        }

        if ($user->role === 1) {
            $bookIssuances = BookIssuance::with(['user', 'book'])->get();
        } else {
            $bookIssuances = BookIssuance::with(['user', 'book'])
                ->where('user_id', $userId)
                ->get();
        }
        $data = $bookIssuances->map(function ($issuance) {
            return [
                'id' => $issuance->id,
                'book_title' => $issuance->book->title,
                'user_name' => $issuance->user->name,
                'issued_date' => $issuance->issued_date,
                'received_date' => $issuance->received_date,
                'status' => $issuance->status,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }

    // Create new book issuance
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'user_id' => 'required|exists:users,id',
            'issued_date' => 'required|date',
        ]);

        // Decrease book stock
        $book = Book::find($request->book_id);
        if ($book->stock <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'Book is out of stock.'
            ], 400);
        }

        $book->stock -= 1;
        $book->save();

        // Create a new book issuance
        $bookIssuance = BookIssuance::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Book issued successfully.',
            'data' => $bookIssuance
        ], 201);
    }

    // Mark a book as received
    public function receive($id)
    {
        $record = BookIssuance::find($id);

        if (!$record) {
            return response()->json([
                'success' => false,
                'message' => 'Book issuance record not found.'
            ], 404);
        }

        if ($record->status === 'received') {
            return response()->json([
                'success' => false,
                'message' => 'Book has already been received.'
            ], 400);
        }

        // Update record status and return book to stock
        $record->status = 'received';
        $record->received_date = now();
        $record->save();

        $book = Book::find($record->book_id);
        $book->stock += 1;
        $book->save();

        return response()->json([
            'success' => true,
            'message' => 'Book received successfully.',
            'data' => $record
        ], 200);
    }
    public function getByUser($userId)
    {
        $bookIssuances = BookIssuance::with(['book'])  // You can also include other related models like 'user' if needed
        ->where('user_id', $userId)
            ->get();

        if ($bookIssuances->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No book issuances found for this user.'
            ], 404);
        }

        $data = $bookIssuances->map(function ($issuance) {
            return [
                'id' => $issuance->id,
                'book_title' => $issuance->book->title,
                'issued_date' => $issuance->issued_date,
                'received_date' => $issuance->received_date,
                'status' => $issuance->status,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }
}
