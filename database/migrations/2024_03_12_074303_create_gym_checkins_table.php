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
        Schema::create('gym_check_ins', function (Blueprint $table) {
            $table->id(); // Auto-incremental primary key
            $table->foreignId('gym_members_id')->constrained('gym_members');
            $table->timestamp('check_in_datetime');
            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gym_check_ins');
    }
};

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration
// {
//     /**
//      * Run the migrations.
//      */
//     public function up(): void
//     {
//         Schema::create('gym_check_ins', function (Blueprint $table) {
//             $table->id(); // Auto-incremental primary key
//             $table->foreignId('gym_members_id')->constrained('gym_members');
//             $table->dateTime('check_in_datetime');
//             $table->timestamps(); // Created_at and updated_at timestamps
//         });
//     }

//     /**
//      * Reverse the migrations.
//      */
//     public function down(): void
//     {
//         Schema::dropIfExists('gym_checkins');
//     }
// };
