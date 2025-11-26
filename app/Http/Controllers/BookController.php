<?php


// app/Http/Controllers/ContactController.php
namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class BookController extends Controller
{
    public function create()
    {
        return view('book.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'aname'  => 'required',
            'description'  => 'required',
            'bname'  => 'required',
            'available' => 'required',
            'price' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // validate image

        ]);

        $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('books', 'public');
    }


         Book::create([
        'aname'     => $request->aname,
    'description'=> $request->description, // correct value

        'bname'     => $request->bname,
        'available' => $request->available,
        'price'     => $request->price,
        'image'     => $imagePath,
    ]);

    

        // Save or process data...

        return back()->with('success', 'Form submitted successfully!');
    }

    public function index()
    {
        $books = Book::all(); // Fetch all books
        return view('book.index', compact('books')); // Pass to view

        
    }

    // Show edit form
    public function edit(Book $book)
    {
        return view('book.edit', compact('book'));
    }

    // Update book
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'aname'  => 'required',
            'description'=> 'required',
            'bname'  => 'required',
            'available' => 'required',
            'price' => 'required',
            'image' => 'nullable|image|mimes:png|max:2048',
        ]);

        $data = $request->only(['aname', 'bname', 'available', 'price']);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($book->image && Storage::disk('public')->exists($book->image)) {
                Storage::disk('public')->delete($book->image);
            }
            $data['image'] = $request->file('image')->store('books', 'public');
        }

        $book->update($data);

        return redirect()->route('book.index')->with('success', 'Book updated successfully!');
    }

    public function favorite(Book $book, Request $request)
{
    $book->favorite = $request->favorite ? true : false;
    $book->save();

    return response()->json(['success' => true]);
}


    // Delete book
    public function destroy(Book $book)
    {
        // Delete image from storage
        if ($book->image && Storage::disk('public')->exists($book->image)) {
            Storage::disk('public')->delete($book->image);
        }

        $book->delete();

        return redirect()->route('book.index')->with('success', 'Book deleted successfully!');
    }

    public function show(Book $book)
{
    // Pass the selected book to the view
    return view('book.show', compact('book'));
}

public function favorites()
{
    $books = Book::where('favorite', 1)->get();

    return view('cart', compact('books'));
}

}
