<?php

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
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            // File and photo columns

            $table->string('photo')->nullable();
            $table->string('resume')->nullable();

            // Foreign key constraints

            $table->foreignId('resignation_id')->nullable()->references('id')->on('resignations');
            $table->foreignId('religion_id')->references('id')->on('religions');
            $table->foreignId('qualification_id')->references('id')->on('qualifications');
            $table->foreignId('occasion_id')->nullable()->references('id')->on('occasions');
            $table->foreignId('nationality_id')->references('id')->on('nationalities');
            $table->foreignId('branch_id')->references('id')->on('branches');

            

            $table->foreignId('admin_id')->references('id')->on('admins');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employers');
    }
};
