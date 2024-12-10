<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class bukuController extends Controller
{
    public function index()
    {
        $books = Buku::all();
        return view('main', compact('books'));
    }

    public function create()
    {
        return view('buku.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'isbn' => 'required|string|unique:bukus|max:255',
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1000|max:9999',
        ]);

        Buku::create([
            'isbn' => $request->isbn,
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
            'tahun' => $request->tahun,
        ]);

        return redirect()->route('bukus.index')->with('success', 'Buku added successfully!');
    }

    public function edit($id)
    {
        $book = buku::findOrFail($id);
        return view('buku.edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1000|max:9999',
        ]);

        $book = Buku::findOrFail($id);
        $book->update([
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
            'tahun' => $request->tahun,
        ]);

        return redirect()->route('bukus.index')->with('success', 'Buku updated successfully!');
    }


    public function destroy($id)
    {
        $book = buku::findOrFail($id);
        $book->delete();

        return redirect()->route('bukus.index')->with('success', 'Buku deleted');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $books = Buku::where('judul', 'like', '%' . $query . '%')
                    ->orWhere('pengarang', 'like', '%' . $query . '%')
                    ->orWhere('tahun', 'like', '%' . $query . '%')
                    ->get();

        return view('main', compact('books'))->with('success', "Results for '$query'");
    }
}
