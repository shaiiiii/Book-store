<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\BookIssuance;
use RealRashid\SweetAlert\Facades\Alert;


class BookIssuanceController extends Controller
{
    public function index()
    {
        $bookIssuances = BookIssuance::all();
        return view('Admin.book-issue.index', compact('bookIssuances'));
    }
    public function create()
    {
        $books = Book::where('stock','>',0)->get();
        $users=User::where('role', '!=', 1)->get();
        return view('Admin.book-issue.create',compact('users','books'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'user_id' => 'required|exists:users,id',
            'issued_date' => 'required|date',

        ]);
        $book=Book::find($request->book_id);
        $book->stock -=1;
        $book->save();
        // Create a new book issuance
        BookIssuance::create(request()->all());

        Alert::success('Book issued successfully.',"You have issued a book");

        return redirect()->route('book-issuances.create');
    }

    public function receive($id)
    {

        $record=BookIssuance::find($id);
        $record->status = 'received';
        $record->received_date = now();
        $record->save();
        $book=Book::find($record->book_id);
        $book->stock +=1;
        $book->save();

        Alert::success('status changed.',"You have chabged status to recived");
        return redirect()->route('book-issuances.index')->with('success', 'Book received successfully.');
    }
}
