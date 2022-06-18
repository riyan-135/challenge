<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function store(Request $request){
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->role = 'non-admin';
            $user->save();
            return redirect('/user')->with('success', 'User created successfully');
        } catch (\Exception $e) {
            return redirect('/user')->with('error', $e->getMessage());
        }
    }

    public function edit($id){
        $user = User::find($id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id){
        try {
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->role = 'non-admin';
            $user->save();
            return redirect('/user')->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            return redirect('/user')->with('error', $e->getMessage());
        }
    }

    public function destroy($id){
        try {
            $user = User::find($id);
            $user->delete();
            return redirect('/user')->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            return redirect('/user')->with('error', $e->getMessage());
        }
    }

    public function userFront(){
        $book = Book::with(['created_book'])->get();
        return view('FrontUser.index', compact('book'));
    }
}
