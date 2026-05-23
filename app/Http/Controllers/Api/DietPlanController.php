<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DietPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DietPlanController extends Controller
{
    /**
     * Display a paginated, searchable listing of diet plans.
     */
    public function index(Request $request)
    {
        $query = DietPlan::query();

        // Search by name
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        }

        // Sort by newest first
        $query->latest();

        $perPage = $request->input('per_page', 10);
        $plans = $query->paginate($perPage);

        return response()->json($plans);
    }

    /**
     * Store a newly created diet plan.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'         => 'required|string|max:255',
            'description'  => 'required|string',
            'advantages'   => 'nullable|string',
            'suitable_for' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        $plan = DietPlan::create([
            'name'         => $request->name,
            'description'  => $request->description,
            'advantages'   => $request->advantages ?? '',
            'suitable_for' => $request->suitable_for ?? '',
            'is_active'    => true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Diet plan berhasil ditambahkan.',
            'data'    => $plan,
        ], 201);
    }

    /**
     * Display the specified diet plan.
     */
    public function show($id)
    {
        $plan = DietPlan::find($id);

        if (!$plan) {
            return response()->json([
                'success' => false,
                'message' => 'Diet plan tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $plan,
        ]);
    }

    /**
     * Update the specified diet plan.
     */
    public function update(Request $request, $id)
    {
        $plan = DietPlan::find($id);

        if (!$plan) {
            return response()->json([
                'success' => false,
                'message' => 'Diet plan tidak ditemukan.',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name'         => 'sometimes|required|string|max:255',
            'description'  => 'sometimes|required|string',
            'advantages'   => 'nullable|string',
            'suitable_for' => 'nullable|string|max:255',
            'is_active'    => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        $plan->update($request->only([
            'name', 'description', 'advantages', 'suitable_for', 'is_active',
        ]));

        return response()->json([
            'success' => true,
            'message' => 'Diet plan berhasil diperbarui.',
            'data'    => $plan,
        ]);
    }

    /**
     * Remove the specified diet plan.
     */
    public function destroy($id)
    {
        $plan = DietPlan::find($id);

        if (!$plan) {
            return response()->json([
                'success' => false,
                'message' => 'Diet plan tidak ditemukan.',
            ], 404);
        }

        $plan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Diet plan berhasil dihapus.',
        ]);
    }
}