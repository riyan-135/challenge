<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\CreatedBook;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::with(['created_book'])->get();
        $author = CreatedBook::all();
        return view('Admin.pages.book.index', compact('books', 'author'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $pathFile = Storage::putFile("public/images/books", $request->file('image'));

            $book = new Book();
            $book->book_name = $request->book_name;
            $book->author_id = $request->author_id;
            $book->image = $pathFile;
            $book->description = $request->description;
            $book->save();

            return redirect()->back()->with('success', 'Book created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $books = Book::find($id);
            return view('Admin.pages.book.show', compact('books'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $books = Book::find($id);
            $author = CreatedBook::all();
            return view('Admin.pages.book.edit', compact('books', 'author'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $pathFile = Storage::putFile("public/images/books", $request->file('image'));

            $book = Book::find($id);
            $book->book_name = $request->book_name;
            $book->author_id = $request->author_id;
            $book->image = $pathFile;
            $book->description = $request->description;
            $book->save();

            return redirect()->back()->with('success', 'Book updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $book = Book::find($id);
            $book->delete();
            return redirect()->back()->with('success', 'Book deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
