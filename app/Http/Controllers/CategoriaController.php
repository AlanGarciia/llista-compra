<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriaController extends Controller
{
    public function index()
    {
        $usuari = Auth::user();

        if (!$usuari) {
            return redirect()->route('login')->with('error', 'Has d’iniciar sessió.');
        }

        $categories = Categoria::where('user_id', $usuari->id)->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $usuari = Auth::user();
        if (!$usuari) {
            return redirect()->route('login')->with('error', 'Has d’iniciar sessió.');
        }

        Categoria::create([
            'nom' => $request->nom,
            'user_id' => $usuari->id,
        ]);

        return redirect()->route('categories.index')->with('success', 'Categoria creada correctament!');
    }

    public function edit($id)
    {
        $categoria = Categoria::find($id);
        $usuari = Auth::user();

        if (!$categoria || !$usuari || $categoria->user_id !== $usuari->id) {
            return redirect()->route('categories.index')->with('error', 'No pots editar aquesta categoria.');
        }

        return view('categories.edit', ['categoria' => $categoria]);
    }

    public function update(Request $request, $id)
    {
        $categoria = Categoria::find($id);
        $usuari = Auth::user();

        if (!$categoria || !$usuari || $categoria->user_id !== $usuari->id) {
            return redirect()->route('categories.index')->with('error', 'No pots modificar aquesta categoria.');
        }

        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $categoria->update(['nom' => $request->nom]);

        return redirect()->route('categories.index')->with('success', 'Categoria actualitzada correctament!');
    }

    public function destroy($id)
    {
        $categoria = Categoria::find($id);
        $usuari = Auth::user();

        if (!$categoria || !$usuari || $categoria->user_id !== $usuari->id) {
            return redirect()->route('categories.index')->with('error', 'No pots eliminar aquesta categoria.');
        }

        $categoria->delete();

        return redirect()->route('categories.index')->with('success', 'Categoria eliminada correctament!');
    }
}