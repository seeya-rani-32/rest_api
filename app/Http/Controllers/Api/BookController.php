<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // GET /api/books
    public function index()
    {
        $books = Book::all();

        return response()->json([
            'error' => false,
            'message' => 'Books retrieved successfully',
            'data' => $books
        ], 200);
    }

    // POST /api/books
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'year' => 'required|integer',
        ]);

        $book = Book::create($request->all());

        return response()->json([
            'error' => false,
            'message' => 'Book created successfully',
            'data' => $book
        ], 201);
    }

    // GET /api/books/{id}
    public function show($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'error' => true,
                'message' => 'Book not found',
                'data' => null
            ], 404);
        }

        return response()->json([
            'error' => false,
            'message' => 'Book retrieved successfully',
            'data' => $book
        ], 200);
    }

    // PUT /api/books/{id}
    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'error' => true,
                'message' => 'Book not found',
                'data' => null
            ], 404);
        }

        $request->validate([
            'title' => 'string',
            'author' => 'string',
            'year' => 'integer',
        ]);

        $book->update($request->all());

        return response()->json([
            'error' => false,
            'message' => 'Book updated successfully',
            'data' => $book
        ], 200);
    }

    // DELETE /api/books/{id}
    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'error' => true,
                'message' => 'Book not found',
                'data' => null
            ], 404);
        }

        $book->delete();

        return response()->json([
            'error' => false,
            'message' => 'Book deleted successfully',
            'data' => null
        ], 200);
    }
}
