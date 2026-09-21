<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('utilisateurs', function (Blueprint $table) {
            if (!Schema::hasColumn('utilisateurs', 'email_verified_at')) {
                $table->timestamp('email_verified_at')
                    ->nullable()
                    ->after('email');
            }

            if (!Schema::hasColumn('utilisateurs', 'password')) {
                $table->string('password')
                    ->after('email_verified_at');
            }

            if (!Schema::hasColumn('utilisateurs', 'remember_token')) {
                $table->rememberToken()
                    ->after('password');
            }
        });
    }

    public function down(): void
    {
        Schema::table('utilisateurs', function (Blueprint $table) {
            $columns = [];

            if (Schema::hasColumn('utilisateurs', 'email_verified_at')) {
                $columns[] = 'email_verified_at';
            }

            if (Schema::hasColumn('utilisateurs', 'password')) {
                $columns[] = 'password';
            }

            if (Schema::hasColumn('utilisateurs', 'remember_token')) {
                $columns[] = 'remember_token';
            }

            if (!empty($columns)) {
                $table->dropColumn($columns);
            }
        });
    }
};