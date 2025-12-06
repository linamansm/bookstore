<?php


// app/Http/Controllers/ContactController.php
namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;


class BookController extends Controller
{
    public function create()
{
    $categories = Category::all();
    return view('book.create', compact('categories'));
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
$data = $request->only(['aname', 'bname', 'available', 'price']),


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
            'category_id' => $request->category_id,

    ]);

    

        // Save or process data...

        return back()->with('success', 'Form submitted successfully!');
    }

    public function index(Request $request)
{
    $query = Book::query();

    // If a category is selected, filter books
    if ($request->has('category') && $request->category != '') {
        $query->where('category_id', $request->category);
    }

    $books = $query->get();
    $categories = Category::all();

    return view('book.index', compact('books', 'categories'));
}


    // Show edit form
    public function edit(Book $book)
    {
            $categories = Category::all();
    return view('book.edit', compact('book', 'categories'));
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
        'category_id' => 'required',
    ]);

    $data = $request->only(['aname', 'description', 'bname', 'available', 'price', 'category_id']);

    // Handle image upload
    if ($request->hasFile('image')) {
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
