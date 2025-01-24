<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users_new', function (Blueprint $table) {
            $table->id(); // Auto-increment ID
            $table->string('name'); // Full Name
            $table->string('email')->unique(); // Email Address
            $table->string('password'); // Password
            $table->timestamps(); // Created at and Updated at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users_new');
    }
};
