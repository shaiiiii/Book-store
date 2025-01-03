<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;



class BookController extends Controller
{

    public function Home()
    {
        $books = Book::all();
        return view('Admin.home', compact('books'));
    }

    public function create()
    {
        return view('Admin.create');
    }

    public function store(Request $request)
    {
        Log::info('Starting the book creation process.');

        $this->validate($request, [
            'title' => 'required',
            'author' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif', // Validate the image
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

        $book = Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath,
        ]);
        Log::info('Book created successfully.', ['book_id' => $book->id]);

        Alert::success('Book added successfully!', "You have added a book");
        return redirect('admin/books')->with('success', 'Book added successfully!');
    }

    public function edit($id)
    {
        $book = Book::find($id);
        return view('Admin.update', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'author' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $book = Book::find($id);
        $book->update($request->all());
        Alert::success('Book updated successfully!',"You have updated the book");
        return redirect('admin/books');
    }

    public function delete($id)
    {
        $book = Book::find($id);
        $book->issuances()->delete();
        $book->delete();
        Alert::success('Book deleted successfully!',"You have deleted the book");
        return redirect('admin/books');
    }

}
