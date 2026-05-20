<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\DietPlan;
use App\Models\UserDietPlan;
use App\Models\FoodMenu;
use App\Models\Workout;
use App\Models\HealthMetric;
use App\Models\WorkoutRecommendation;
use Maatwebsite\Excel\Facades\Excel;

class DietMateMasterSeeder extends Seeder
{
    public function run(): void
    {
        $filePath = database_path('seeders/excel/dietmate_dataset.xlsx');

        if (!file_exists($filePath)) {
            $this->command->error("File Excel tidak ditemukan di: {$filePath}");
            return;
        }

        $this->command->info("Sedang membaca file Excel, mohon tunggu...");
        $excelData = Excel::toArray([], $filePath);

        // Debugging: Cek apakah excel berhasil dibaca dan tidak kosong
        if (empty($excelData)) {
            $this->command->error("File Excel kosong atau tidak terbaca!");
            return;
        }

        // ─────────────────────────────────────────────
        // 1. SHEET: users (Index 0)
        // ─────────────────────────────────────────────
        $this->command->info("Mengisi tabel: users...");
        $usersSheet = $excelData[0];
        foreach ($usersSheet as $index => $row) {
            if ($index === 0) continue; // Skip header
            if (!isset($row[0]) || $row[0] === null) continue; // Skip baris kosong

            User::create([
                'id'       => $row[0],
                'name'     => $row[1],
                'email'    => $row[2],
                'password' => $row[3],
                'role'     => $row[4],
            ]);
        }

        // ─────────────────────────────────────────────
        // 2. SHEET: user_profiles (Index 1)
        // ─────────────────────────────────────────────
        $this->command->info("Mengisi tabel: user_profiles...");
        $profilesSheet = $excelData[1];
        foreach ($profilesSheet as $index => $row) {
            if ($index === 0) continue;
            if (!isset($row[0]) || $row[0] === null) continue;

            UserProfile::create([
                'id'                   => $row[0],
                'user_id'              => $row[1],
                'age'                  => $row[2],
                'gender'               => $row[3],
                'height_cm'            => $row[4],
                'weight_kg'            => $row[5],
                'activity_level'       => $row[6],
                'bmi'                  => $row[7],
                'daily_calorie_target' => $row[8],
                'diet_goal'            => $row[9],
            ]);
        }

        // ─────────────────────────────────────────────
        // 3. SHEET: diet_plans (Index 2)
        // ─────────────────────────────────────────────
        $this->command->info("Mengisi tabel: diet_plans...");
        $dietPlansSheet = $excelData[2];
        foreach ($dietPlansSheet as $index => $row) {
            if ($index === 0) continue;
            if (!isset($row[0]) || $row[0] === null) continue;

            DietPlan::create([
                'id'           => $row[0],
                'name'         => $row[1],
                'description'  => $row[2],
                'advantages'   => $row[3],
                'suitable_for' => $row[4],
                'is_active'    => filter_var($row[5], FILTER_VALIDATE_BOOLEAN) || $row[5] == 'True' || $row[5] == 1,
            ]);
        }

        // ─────────────────────────────────────────────
        // 4. SHEET: user_diet_plans (Index 3)
        // ─────────────────────────────────────────────
        $this->command->info("Mengisi tabel: user_diet_plans...");
        $udpSheet = $excelData[3];
        foreach ($udpSheet as $index => $row) {
            if ($index === 0) continue;
            if (!isset($row[0]) || $row[0] === null) continue;

            UserDietPlan::create([
                'id'           => $row[0],
                'user_id'      => $row[1],
                'diet_plan_id' => $row[2],
                'is_active'    => filter_var($row[3], FILTER_VALIDATE_BOOLEAN) || $row[3] == 'True' || $row[3] == 1,
            ]);
        }

        // ─────────────────────────────────────────────
        // 5. SHEET: food_menus (Index 4)
        // ─────────────────────────────────────────────
        $this->command->info("Mengisi tabel: food_menus...");
        $foodSheet = $excelData[4];
        foreach ($foodSheet as $index => $row) {
            if ($index === 0) continue;
            if (!isset($row[0]) || $row[0] === null) continue;

            FoodMenu::create([
                'id'          => $row[0],
                'name'        => $row[1],
                'category'    => $row[2],
                'calories'    => $row[3],
                'protein_g'   => $row[4],
                'carbs_g'     => $row[5],
                'fat_g'       => $row[6],
                'description' => $row[7],
                'image_url'   => $row[8],
                'is_active'   => filter_var($row[9], FILTER_VALIDATE_BOOLEAN) || $row[9] == 'True' || $row[9] == 1,
            ]);
        }

        // ─────────────────────────────────────────────
        // 6. SHEET: workouts (Index 5)
        // ─────────────────────────────────────────────
        $this->command->info("Mengisi tabel: workouts...");
        $workoutSheet = $excelData[5];
        foreach ($workoutSheet as $index => $row) {
            if ($index === 0) continue;
            if (!isset($row[0]) || $row[0] === null) continue;

            Workout::create([
                'id'                  => $row[0],
                'name'                => $row[1],
                'duration_minutes'    => $row[2],
                'intensity'           => $row[3],
                'description'         => $row[4],
                'cals_burned_per_min' => $row[5],
            ]);
        }

        // ─────────────────────────────────────────────
        // 7. SHEET: health_metrics (Index 6)
        // ─────────────────────────────────────────────
        $this->command->info("Mengisi tabel: health_metrics...");
        $healthSheet = $excelData[6];
        foreach ($healthSheet as $index => $row) {
            if ($index === 0) continue;
            if (!isset($row[0]) || $row[0] === null) continue;

            HealthMetric::create([
                'id'              => $row[0],
                'user_id'         => $row[1],
                'weight_kg'       => $row[2],
                'bmi'             => $row[3],
                'calories_burned' => $row[4],
                'steps_count'     => $row[5],
                'water_intake'    => $row[6],
                'recorded_date'   => is_numeric($row[7]) ? \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[7]))->format('Y-m-d') : $row[7],
            ]);
        }

        // ─────────────────────────────────────────────
        // 8. SHEET: workout_recommendations (Index 7)
        // ─────────────────────────────────────────────
        $this->command->info("Mengisi tabel: workout_recommendations...");
        $wrSheet = $excelData[7];
        foreach ($wrSheet as $index => $row) {
            if ($index === 0) continue;
            if (!isset($row[0]) || $row[0] === null) continue;

            WorkoutRecommendation::create([
                'id'               => $row[0],
                'user_id'          => $row[1],
                'workout_id'       => $row[2],
                'recorded_date'    => is_numeric($row[3]) ? \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[3]))->format('Y-m-d') : $row[3],
                'is_completed'     => filter_var($row[4], FILTER_VALIDATE_BOOLEAN) || $row[4] == 'True' || $row[4] == 1,
            ]);
        }

        $this->command->info("Semua data Excel sukses masuk ke database!");
    }
}