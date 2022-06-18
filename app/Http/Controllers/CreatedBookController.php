<?php

namespace App\Http\Controllers;

use App\Models\CreatedBook;
use Illuminate\Http\Request;

class CreatedBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $created_books = CreatedBook::all();
        return view('Admin.pages.author.index', compact('created_books'));
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
            $created_book = new CreatedBook();
            $created_book->name = $request->name;
            $created_book->phone = $request->phone;
            $created_book->email = $request->email;
            $created_book->address = $request->address;
            $created_book->save();

            return redirect()->back()->with('success', 'Created book successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CreatedBook  $createdBook
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $created_book = CreatedBook::findOrFail($id);
            return view('Admin.pages.author.show', compact('created_book'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CreatedBook  $createdBook
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $created_book = CreatedBook::findOrFail($id);
            return view('Admin.pages.author.edit', compact('created_book'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CreatedBook  $createdBook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $created_book = CreatedBook::findOrFail($id);
            $created_book->name = $request->name;
            $created_book->phone = $request->phone;
            $created_book->email = $request->email;
            $created_book->address = $request->address;
            $created_book->save();

            return redirect()->route('Admin.pages.author.index')->with('success', 'Created book successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CreatedBook  $createdBook
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $created_book = CreatedBook::findOrFail($id);
            $created_book->delete();

            return redirect()->back()->with('success', 'Created book successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
