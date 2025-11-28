<?php

namespace App\Http\Controllers;

use App\Models\Llista;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LlistaController extends Controller
{
    /*
    public function index()
    {
        $usuari = Auth::user();
        if (!$usuari) {
            return redirect()->route('login')->with('error', 'Has d’iniciar sessió.');
        }

        // Listas propias
        $llistas = Llista::where('user_id', $usuari->id)->with('categoria')->get();

        // Listas compartidas contigo
        $llistasCompartides = $usuari->llistesCompartides()->with('categoria', 'user')->get();

        return view('llistas.index', compact('llistas', 'llistasCompartides'));
    }
    */
    public function index()
{
    $usuari = Auth::user();
    if (!$usuari) {
        return redirect()->route('login')->with('error', 'Has d’iniciar sessió.');
    }

    // NOMÉS les llistes creades pel propi usuari
    $llistas = Llista::where('user_id', $usuari->id)
        ->with(['categoria', 'productes'])
        ->get();

    return view('llistas.index', compact('llistas'));
}

    public function create()
    {
        $usuari = Auth::user();
        if (!$usuari) {
            return redirect()->route('login')->with('error', 'Has d’iniciar sessió.');
        }

        $categories = Categoria::where('user_id', $usuari->id)->get();
        return view('llistas.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titol' => 'required|string|max:255',
            'categoria_id' => 'nullable|exists:categories,id',
            'descripcio' => 'nullable|string|max:500',
        ]);

        $usuari = Auth::user();
        if (!$usuari) {
            return redirect()->route('login')->with('error', 'Has d’iniciar sessió.');
        }

        Llista::create([
            'titol' => $request->titol,
            'descripcio' => $request->descripcio,
            'categoria_id' => $request->categoria_id,
            'user_id' => $usuari->id,
        ]);

        return redirect()->route('llistas.index')->with('success', 'Llista creada correctament!');
    }

    public function edit($id)
    {
        $llista = Llista::find($id);
        $usuari = Auth::user();

        if (!$llista || !$usuari || $llista->user_id !== $usuari->id) {
            return redirect()->route('llistas.index')->with('error', 'No pots editar aquesta llista.');
        }

        $categories = Categoria::where('user_id', $usuari->id)->get();
        return view('llistas.edit', compact('llista', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $llista = Llista::find($id);
        $usuari = Auth::user();

        if (!$llista || !$usuari || $llista->user_id !== $usuari->id) {
            return redirect()->route('llistas.index')->with('error', 'No pots modificar aquesta llista.');
        }

        $request->validate([
            'titol' => 'required|string|max:255',
            'categoria_id' => 'nullable|exists:categories,id',
            'descripcio' => 'nullable|string|max:500',
        ]);

        $llista->update([
            'titol' => $request->titol,
            'descripcio' => $request->descripcio,
            'categoria_id' => $request->categoria_id,
        ]);

        return redirect()->route('llistas.index')->with('success', 'Llista actualitzada correctament!');
    }

    public function destroy($id)
    {
        $llista = Llista::find($id);
        $usuari = Auth::user();

        if (!$llista || !$usuari || $llista->user_id !== $usuari->id) {
            return redirect()->route('llistas.index')->with('error', 'No pots eliminar aquesta llista.');
        }

        $llista->delete();

        return redirect()->route('llistas.index')->with('success', 'Llista eliminada correctament!');
    }


    public function compartir(Request $request, $id){
        $usuari = Auth::user();
        $llista = Llista::find($id);

        if (!$llista || $llista->user_id !== $usuari->id) {
            return redirect()->route('llistas.index')->with('error', 'No pots compartir aquesta llista.');
        }

        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $usuariCompartit = \App\Models\User::where('email', $request->email)->first();

        if (!$llista->users->contains($usuariCompartit->id)) {
            $llista->users()->attach($usuariCompartit->id);
        }

        return redirect()->route('llistas.index')->with('success', 'Llista compartida correctament amb ' . $usuariCompartit->name);
    }

}