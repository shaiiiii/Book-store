<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    /**
     * Get all books.
     */
    public function Home()
    {
        $books = Book::all();
        return response()->json([
            'status' => 'success',
            'data' => $books
        ], 200);
    }

    /**
     * Store a new book.
     */
    public function store(Request $request)
    {
        Log::info('Starting the book creation process.');

        $validatedData = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image
        ]);
        Log::info('Validation passed.');

        $imagePath = null;
        if ($request->hasFile('image')) {
            Log::info('Image file found, starting upload process.');
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('books', $imageName, 'public');
            Log::info('Image uploaded successfully.', ['image_path' => $imagePath]);
        }

        $validatedData['image'] = $imagePath;
        $book = Book::create($validatedData);
        Log::info('Book created successfully.', ['book_id' => $book->id]);

        return response()->json([
            'status' => 'success',
            'message' => 'Book added successfully!',
            'data' => $book
        ], 201);
    }

    /**
     * Get a single book by ID.
     */
    public function edit($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'status' => 'error',
                'message' => 'Book not found.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $book
        ], 200);
    }

    /**
     * Update an existing book.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'status' => 'error',
                'message' => 'Book not found.'
            ], 404);
        }

        $book->update($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Book updated successfully!',
            'data' => $book
        ], 200);
    }

    /**
     * Delete a book by ID.
     */
    public function delete($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'status' => 'error',
                'message' => 'Book not found.'
            ], 404);
        }

        // Delete related issuances first
        $book->issuances()->delete();
        $book->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Book deleted successfully!'
        ], 200);
    }
}
