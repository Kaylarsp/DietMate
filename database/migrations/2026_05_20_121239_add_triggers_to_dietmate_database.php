<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. TRIGGER: Hitung BMI Otomatis Sebelum Insert ke user_profiles
        DB::unprepared("
            CREATE TRIGGER before_user_profiles_insert
            BEFORE INSERT ON user_profiles
            FOR EACH ROW
            BEGIN
                IF NEW.height_cm > 0 THEN
                    SET NEW.bmi = NEW.weight_kg / POWER((NEW.height_cm / 100), 2);
                ELSE
                    SET NEW.bmi = 0;
                END IF;
            END
        ");

        // 2. TRIGGER: Hitung Ulang BMI Otomatis Sebelum Update pada user_profiles
        DB::unprepared("
            CREATE TRIGGER before_user_profiles_update
            BEFORE UPDATE ON user_profiles
            FOR EACH ROW
            BEGIN
                IF NEW.height_cm > 0 THEN
                    SET NEW.bmi = NEW.weight_kg / POWER((NEW.height_cm / 100), 2);
                ELSE
                    SET NEW.bmi = 0;
                END IF;
            END
        ");

        // 3. TRIGGER: Sinkronisasi Berat Badan & Hitung BMI Otomatis dari health_metrics ke user_profiles
        DB::unprepared("
            CREATE TRIGGER after_health_metrics_insert
            AFTER INSERT ON health_metrics
            FOR EACH ROW
            BEGIN
                -- Update berat badan di tabel utama user_profiles berdasarkan log harian terbaru
                UPDATE user_profiles 
                SET weight_kg = NEW.weight_kg
                WHERE user_id = NEW.user_id;
            END
        ");

        // 4. TRIGGER: Otomatis Buat Baris Kosong di user_profiles Setelah User Sukses Register
        /* DB::unprepared("
            CREATE TRIGGER after_users_register
            AFTER INSERT ON users
            FOR EACH ROW
            BEGIN
                -- Memicu pembuatan profile kosong hanya jika yang mendaftar adalah 'user' biasa
                IF NEW.role = 'user' THEN
                    INSERT INTO user_profiles (user_id, age, gender, height_cm, weight_kg, activity_level, bmi, daily_calorie_target, diet_goal, created_at, updated_at)
                    VALUES (NEW.id, 0, 'Not Set', 0.0, 0.0, 'Not Set', 0.00, 0, 'Not Set', NOW(), NOW());
                END IF;
            END
        ");

        */

        // 5. TRIGGER: Validasi Status Penyelesaian Rekomendasi Olahraga Sebelum Data Diubah
        // Catatan: Jika ada track record harian health_metrics yang mencatat kalori terbakar, 
        // ia akan mencoba memastikan kesesuaian data log atau memicu validasi logis.
        DB::unprepared("
            CREATE TRIGGER before_health_metrics_insert_validation
            BEFORE INSERT ON health_metrics
            FOR EACH ROW
            BEGIN
                -- Mencegah input data steps atau kalori negatif yang tidak logis lewat database
                IF NEW.calories_burned < 0 OR NEW.steps_count < 0 OR NEW.water_intake < 0 THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'Gagal Simpan: Metrik kesehatan (kalori, langkah kaki, air) tidak boleh bernilai negatif!';
                END IF;
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus trigger secara aman jika migration di-rollback
        DB::unprepared("DROP TRIGGER IF EXISTS before_user_profiles_insert");
        DB::unprepared("DROP TRIGGER IF EXISTS before_user_profiles_update");
        DB::unprepared("DROP TRIGGER IF EXISTS after_health_metrics_insert");
        DB::unprepared("DROP TRIGGER IF EXISTS after_users_register");
        DB::unprepared("DROP TRIGGER IF EXISTS before_health_metrics_insert_validation");
    }
};