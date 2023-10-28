<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index() {
        $books = Books::all();
        return response()->json($books);
    }

    public function store(Request $request) {
        $book = new Books();
        $book->name = $request->name;
        $book->author = $request->author;
        $book->publish_Date = $request->publish_date;
        $book->save();
        return response()->json(['message' => 'Книга добавлена'], 201);
    }

    public function show($id) {
        $book = Books::find($id);
        if (!empty($book)) {
            return response()->json($book);
        } else {
            return response()->json(['message' => 'Книга не найдена'], 404);
        }
    }

    public function update(Request $request, $id) {
        if (Books::where('id', $id)->exists()) {
            $book = Books::find($id);
            if (!is_null($request->name)) $book->name = $request->name;
            if (!is_null($request->author)) $book->author = $request->author;
            if (!is_null($request->publish_date)) $book->publish_date = $request->publish_date;
            $book->save();
            return response()->json(['message' => 'Книга обновлена']);
        } else {
            return response()->json(['message' => 'Книга не найдена'], 404);
        }
    }

    public function destroy($id) {
        if (Books::where('id', $id)->exists()) {
            $book = Books::find($id);
            $book->delete();
            return response()->json(['message' => 'Книга удалена'], 202);
        } else {
            return response()->json(['message' => 'Книга не найдена'], 404);
        }
    }
}
