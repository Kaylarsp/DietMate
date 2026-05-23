<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserProfileController extends Controller
{
    /**
     * Display a paginated, searchable listing of user profiles.
     */
    public function index(Request $request)
    {
        $query = UserProfile::with('user');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('user_id', 'like', "%{$search}%")
                    ->orWhere('gender', 'like', "%{$search}%")
                    ->orWhere('activity_level', 'like', "%{$search}%")
                    ->orWhere('diet_goal', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        $query->latest();

        $perPage = $request->input('per_page', 10);
        $profiles = $query->paginate($perPage);

        return response()->json($profiles);
    }

    /**
     * Display the specified profile.
     */
    public function show($id)
    {
        $profile = UserProfile::with('user')->find($id);

        if (!$profile) {
            return response()->json([
                'success' => false,
                'message' => 'Profil user tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $profile,
        ]);
    }

    /**
     * Update the specified profile.
     */
    public function update(Request $request, $id)
    {
        $profile = UserProfile::find($id);

        if (!$profile) {
            return response()->json([
                'success' => false,
                'message' => 'Profil user tidak ditemukan.',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'age' => 'required|integer|min:0',
            'gender' => 'required|string|max:50',
            'height_cm' => 'required|numeric|min:0',
            'weight_kg' => 'required|numeric|min:0',
            'activity_level' => 'required|string|max:100',
            'bmi' => 'required|numeric|min:0',
            'daily_calorie_target' => 'required|integer|min:0',
            'diet_goal' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $profile->update($request->only([
            'user_id',
            'age',
            'gender',
            'height_cm',
            'weight_kg',
            'activity_level',
            'bmi',
            'daily_calorie_target',
            'diet_goal',
        ]));

        return response()->json([
            'success' => true,
            'message' => 'Profil user berhasil diperbarui.',
            'data' => $profile->fresh(),
        ]);
    }

    /**
     * Remove the specified profile.
     */
    public function destroy($id)
    {
        $profile = UserProfile::find($id);

        if (!$profile) {
            return response()->json([
                'success' => false,
                'message' => 'Profil user tidak ditemukan.',
            ], 404);
        }

        $profile->delete();

        return response()->json([
            'success' => true,
            'message' => 'Profil user berhasil dihapus.',
        ]);
    }
}
