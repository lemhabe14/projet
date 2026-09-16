<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('admins');
        Schema::dropIfExists('users');
    }

    public function down(): void
    {
        // ماشي مهم نرجعوهم
    }
};