<?php

namespace App\Http\Controllers;

use App\Models\Producte;
use App\Models\Llista;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProducteController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'quantitat' => 'required|integer|min:1',
            'llista_id' => 'required|exists:llistas,id',
            'categoria_id' => 'nullable|exists:categories,id',
        ]);

        $llista = Llista::findOrFail($request->llista_id);

        $llista->productes()->create([
            'nom' => $request->nom,
            'quantitat' => $request->quantitat,
            'categoria_id' => $request->categoria_id,
            'comprat' => false,
        ]);

        return $this->redirectBack('Producte afegit correctament!');
    }

    public function update(Request $request, $id)
    {
        $producte = Producte::findOrFail($id);

        $request->validate([
            'nom' => 'required|string|max:255',
            'quantitat' => 'required|integer|min:1',
            'categoria_id' => 'nullable|exists:categories,id',
        ]);

        $producte->update([
            'nom' => $request->nom,
            'quantitat' => $request->quantitat,
            'categoria_id' => $request->categoria_id,
        ]);

        return $this->redirectBack('Producte actualitzat correctament!');
    }

    public function toggleComprat(Request $request, $id)
    {
        $producte = Producte::findOrFail($id);

        $producte->update([
            'comprat' => $request->has('comprat'),
        ]);

        return $this->redirectBack('Producte marcat correctament!');
    }

    public function destroy(Request $request, $id)
    {
        $producte = Producte::findOrFail($id);
        $producte->delete();

        return $this->redirectBack('Producte eliminat correctament!');
    }

    /**
     * Redirigir según la vista desde donde viene el formulario
     */
    private function redirectBack($message)
    {
        if (request()->input('redirect_to') === 'compartidas') {
            return redirect()->route('llistas.compartidas')->with('success', $message);
        }

        return redirect()->route('llistas.index')->with('success', $message);
    }
}
