<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ✅ SAFE CHECK (important)
        if (!Schema::hasColumn('students', 'password')) {
            Schema::table('students', function (Blueprint $table) {
                $table->string('password')->after('email');
            });
        }

        if (!Schema::hasColumn('students', 'must_change_password')) {
            Schema::table('students', function (Blueprint $table) {
                $table->boolean('must_change_password')
                      ->default(true)
                      ->after('password');
            });
        }
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            if (Schema::hasColumn('students', 'password')) {
                $table->dropColumn('password');
            }

            if (Schema::hasColumn('students', 'must_change_password')) {
                $table->dropColumn('must_change_password');
            }
        });
    }
};