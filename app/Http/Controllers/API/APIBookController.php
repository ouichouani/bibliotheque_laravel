<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class APIBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $book = Book::withTrashed()->get();
        return response()->json(
            ['function' => 'show' ,
            'book' => $book] , 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $book = new Book;
        

        $validation_data = $request->validate([
            'designation' => 'unique:books,designation',
            'description' => 'required',
            'auteur' => 'required',
            'type' => 'required',
            'categorie' => 'required',
            'editeur' => 'required',
            'langue' => 'required',
            'prix' => 'min:0',
            'cover' => 'nullable|mimes:jpeg,png,jpg,',
        ]);

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/img/book'), $filename);
            $book->cover = $filename;
        }

        $book->type = $validation_data['type'];
        $book->categorie = $validation_data['categorie'];
        $book->langue = $validation_data['langue'];
        $book->editeur = $validation_data['editeur'];
        $book->designation = $validation_data['designation'];
        $book->auteur = $validation_data['auteur'];
        $book->description = $validation_data['description'];
        $book->prix = $validation_data['prix'];
        $book->save();
        // event(new CreateBookEvent($book));
        return response()->json($book);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return response()->json(
            ['function' => 'show' ,
            'book' => $book] , 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        dd('hello') ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        // Validate incoming request
        $request->validate([
            'designation' => 'required|string',
            'description' => 'required|string',
            'auteur' => 'required|string',
            'type' => 'required|string',
            'categorie' => 'required|string',
            'editeur' => 'required|string',
            'langue' => 'required|string',
            'prix' => 'required|numeric',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Cover validation
        ]);
    
        // Handle file upload if a new cover is provided
        if ($request->hasFile('cover')) {
            // Delete old cover if it's not the default image
            if ($book->cover && $book->cover !== 'book.png') {
                $oldCoverPath = public_path('assets/img/book/' . $book->cover);
                if (file_exists($oldCoverPath)) {
                    unlink($oldCoverPath);
                }
            }
    
            // Store the new cover
            $file = $request->file('cover');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/img/book'), $filename);
    
            // Assign the new cover filename
            $book->cover = $filename;
        }
    
        // Update other book details (excluding cover)
        $book->update($request->except('cover'));
    
        // Save the book with the new cover (if updated)
        $book->save();
    
        // Return the updated book
        return response()->json([
            'message' => 'Book updated successfully',
            'book' => $book
        ], 200);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        $book->save();
        return response()->json([
            'content' => 'the book ' . $book->id .' is deleted ' ,
            'book' => $book,
        ], 200);
    }
}
