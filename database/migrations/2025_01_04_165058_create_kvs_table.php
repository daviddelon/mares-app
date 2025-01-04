<?php

use App\Models\Mare;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kvs', function (Blueprint $table) {
            $table->id();
            $table->string('identifier',32);
            $table->string('content'); // 255
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(Mare::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kvs');
    }
};
