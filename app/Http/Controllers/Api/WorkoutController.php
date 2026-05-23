<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Workout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WorkoutController extends Controller
{
    /**
     * Display a paginated, searchable listing of workouts.
     */
    public function index(Request $request)
    {
        $query = Workout::query();

        // Search by name
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        }

        // Sort by newest first
        $query->latest();

        $perPage = $request->input('per_page', 10);
        $workouts = $query->paginate($perPage);

        return response()->json($workouts);
    }

    /**
     * Store a newly created workout.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'               => 'required|string|max:255',
            'duration_minutes'   => 'required|integer|min:1',
            'intensity'          => 'required|string|max:255',
            'description'        => 'required|string',
            'cals_burned_per_min'=> 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        $workout = Workout::create([
            'name'               => $request->name,
            'duration_minutes'   => $request->duration_minutes,
            'intensity'          => $request->intensity,
            'description'        => $request->description ?? '',
            'cals_burned_per_min'=> $request->cals_burned_per_min ?? 0,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Workout berhasil ditambahkan.',
            'data'    => $workout,
        ], 201);
    }

    /**
     * Display the specified workout.
     */
    public function show($id)
    {
        $workout = Workout::find($id);

        if (!$workout) {
            return response()->json([
                'success' => false,
                'message' => 'Workout tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $workout,
        ]);
    }

    /**
     * Update the specified workout.
     */
    public function update(Request $request, $id)
    {
        $workout = Workout::find($id);

        if (!$workout) {
            return response()->json([
                'success' => false,
                'message' => 'Workout tidak ditemukan.',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name'               => 'sometimes|required|string|max:255',
            'duration_minutes'   => 'sometimes|required|integer|min:1',
            'intensity'          => 'sometimes|required|string|max:255',
            'description'        => 'sometimes|required|string',
            'cals_burned_per_min'=> 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        $workout->update($request->only([
            'name', 'duration_minutes', 'intensity', 'description', 'cals_burned_per_min',
        ]));

        return response()->json([
            'success' => true,
            'message' => 'Workout berhasil diperbarui.',
            'data'    => $workout,
        ]);
    }

    /**
     * Remove the specified workout.
     */
    public function destroy($id)
    {
        $workout = Workout::find($id);

        if (!$workout) {
            return response()->json([
                'success' => false,
                'message' => 'Workout tidak ditemukan.',
            ], 404);
        }

        $workout->delete();

        return response()->json([
            'success' => true,
            'message' => 'Workout berhasil dihapus.',
        ]);
    }
}