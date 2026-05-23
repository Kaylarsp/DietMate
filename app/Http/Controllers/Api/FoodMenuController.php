<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FoodMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FoodMenuController extends Controller
{
    /**
     * Display a paginated, searchable listing of food menus.
     */
    public function index(Request $request)
    {
        $query = FoodMenu::query();

        // Search by name
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        // Sort by newest first
        $query->latest();

        $perPage = $request->input('per_page', 10);
        $menus = $query->paginate($perPage);

        return response()->json($menus);
    }

    /**
     * Store a newly created food menu.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category' => 'required|string|in:sarapan,siang,malam,snack',
            'calories' => 'required|integer|min:0',
            'protein_g' => 'nullable|integer|min:0',
            'carbs_g' => 'nullable|integer|min:0',
            'fat_g' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'image_url' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $menu = FoodMenu::create([
            'name' => $request->name,
            'category' => $request->category,
            'calories' => $request->calories,
            'protein_g' => $request->protein_g ?? 0,
            'carbs_g' => $request->carbs_g ?? 0,
            'fat_g' => $request->fat_g ?? 0,
            'description' => $request->description ?? '',
            'image_url' => $request->image_url ?? '',
            'is_active' => true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Menu berhasil ditambahkan.',
            'data' => $menu,
        ], 201);
    }

    /**
     * Display the specified food menu.
     */
    public function show($id)
    {
        $menu = FoodMenu::find($id);

        if (! $menu) {
            return response()->json([
                'success' => false,
                'message' => 'Menu tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $menu,
        ]);
    }

    /**
     * Update the specified food menu.
     */
    public function update(Request $request, $id)
    {
        $menu = FoodMenu::find($id);

        if (! $menu) {
            return response()->json([
                'success' => false,
                'message' => 'Menu tidak ditemukan.',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'category' => 'sometimes|required|string|in:sarapan,siang,malam,snack',
            'calories' => 'sometimes|required|integer|min:0',
            'protein_g' => 'nullable|integer|min:0',
            'carbs_g' => 'nullable|integer|min:0',
            'fat_g' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'image_url' => 'nullable|string|max:255',
            'is_active' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $menu->update($request->only([
            'name', 'category', 'calories', 'protein_g',
            'carbs_g', 'fat_g',    'description' => $request->description ?? '', 'image_url', 'is_active',
        ]));

        return response()->json([
            'success' => true,
            'message' => 'Menu berhasil diperbarui.',
            'data' => $menu,
        ]);
    }

    /**
     * Remove the specified food menu.
     */
    public function destroy($id)
    {
        $menu = FoodMenu::find($id);

        if (! $menu) {
            return response()->json([
                'success' => false,
                'message' => 'Menu tidak ditemukan.',
            ], 404);
        }

        $menu->delete();

        return response()->json([
            'success' => true,
            'message' => 'Menu berhasil dihapus.',
        ]);
    }
}
