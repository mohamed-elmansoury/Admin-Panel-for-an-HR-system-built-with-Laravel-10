<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('months', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_en');
            
        });
        DB::table('months')->insert([
            ['name'=>'يناير','name_en'=>'January'],
        ['name'=>'فبراير','name_en'=>'February'],
        ['name'=>'مارس','name_en'=>'March'],
        ['name'=>'أبريل','name_en'=>'April'],
        ['name'=>'مايو','name_en'=>'May'],
        ['name'=>'يونيو','name_en'=>'June'],
        ['name'=>'يوليو','name_en'=>'July'],
        ['name'=>'أغسطس','name_en'=>'August'],
        ['name'=>'سبتمبر','name_en'=>'September'],
        ['name'=>'اكتوبر','name_en'=>'October'],
        ['name'=>'نوفمبر','name_en'=>'November'],
        ['name'=>'ديسمبر','name_en'=>'December'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('months');
    }
};
