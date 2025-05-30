<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Animal; // Assurez-vous que le namespace du modèle est correct
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Pour le débogage serveur

class AnimalController extends Controller
{
    /**
     * Affiche la liste des animaux.
     */
    public function index()
    {
        $animals = Animal::latest()->get(); // Récupère les animaux, les plus récents d'abord
        return view('admin.animals.index', compact('animals'));
    }

    /**
     * Affiche le formulaire pour créer un nouvel animal.
     * (Peut ne pas être nécessaire si vous utilisez un modal sur la page index)
     */
    public function create()
    {
        return view('admin.animals.create'); // Vue pour le formulaire de création
    }

    /**
     * Enregistre un nouvel animal dans la base de données.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'habitat' => 'nullable|string|max:255', // Rendu nullable si non toujours requis
            'origin' => 'nullable|string|max:255',  // Rendu nullable si non toujours requis
            'status' => 'required|string|in:active,inactive',
        ]);

        try {
            Animal::create($validatedData);
            Log::info('Animal créé avec succès:', $validatedData);
            return redirect()->route('admin.animals.index')->with('success', 'Animal ajouté avec succès.');
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création de l\'animal:', ['error' => $e->getMessage(), 'data' => $validatedData]);
            return redirect()->back()->withInput()->with('error', 'Une erreur est survenue lors de l\'ajout de l\'animal.');
        }
    }

    /**
     * Affiche les détails d'un animal spécifique.
     * (Utile si vous avez une page de détail pour chaque animal)
     */
    public function show(Animal $animal) // Utilisation du Route Model Binding
    {
        return view('admin.animals.show', compact('animal')); // Vue pour afficher un animal
    }

    /**
     * Affiche le formulaire pour modifier un animal existant.
     * (Peut ne pas être nécessaire si vous utilisez un modal sur la page index)
     */
    public function edit(Animal $animal) // Utilisation du Route Model Binding
    {
        return view('admin.animals.edit', compact('animal')); // Vue pour le formulaire d'édition
    }

    /**
     * Met à jour un animal existant dans la base de données.
     */
    public function update(Request $request, Animal $animal) // Utilisation du Route Model Binding
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'habitat' => 'nullable|string|max:255',
            'origin' => 'nullable|string|max:255',
            'status' => 'required|string|in:active,inactive',
        ]);

        try {
            $animal->update($validatedData);
            Log::info('Animal mis à jour avec succès:', ['id' => $animal->id, 'data' => $validatedData]);
            return redirect()->route('admin.animals.index')->with('success', 'Animal mis à jour avec succès.');
        } catch (\Exception $e) {
            Log::error('Erreur lors de la mise à jour de l\'animal:', ['id' => $animal->id, 'error' => $e->getMessage(), 'data' => $validatedData]);
            return redirect()->back()->withInput()->with('error', 'Une erreur est survenue lors de la mise à jour de l\'animal.');
        }
    }

    /**
     * Supprime un animal de la base de données.
     */
    public function destroy(Animal $animal) // Utilisation du Route Model Binding
    {
        try {
            $animalName = $animal->name; // Garder le nom pour le message
            $animal->delete();
            Log::info('Animal supprimé avec succès:', ['name' => $animalName, 'id' => $animal->id]);
            return redirect()->route('admin.animals.index')->with('success', 'Animal "' . $animalName . '" supprimé avec succès.');
        } catch (\Exception $e) {
            Log::error('Erreur lors de la suppression de l\'animal:', ['id' => $animal->id, 'error' => $e->getMessage()]);
            return redirect()->route('admin.animals.index')->with('error', 'Une erreur est survenue lors de la suppression de l\'animal.');
        }
    }

    /**
     * Met à jour le statut (actif/inactif) d'un animal.
     * Appelée via AJAX par le toggle switch.
     */
    public function updateStatus(Request $request, Animal $animal) // Utilisation du Route Model Binding
    {
        try {
            // Inverser le statut actuel
            $newStatus = ($animal->status === 'active') ? 'inactive' : 'active';
            $animal->status = $newStatus;
            $animal->save();

            Log::info('Statut de l\'animal mis à jour:', ['id' => $animal->id, 'new_status' => $newStatus]);

            return response()->json([
                'success' => true,
                'message' => 'Statut de l\'animal mis à jour avec succès.',
                'new_status' => $newStatus
            ]);

        } catch (\Exception $e) {
            Log::error("Erreur lors de la mise à jour du statut pour l'animal ID " . $animal->id . ": " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour du statut.'
            ], 500); // Code d'erreur HTTP 500 pour indiquer une erreur serveur
        }
    }
}