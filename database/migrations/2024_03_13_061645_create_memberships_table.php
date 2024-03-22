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
        Schema::create('memberships', function (Blueprint $table) {
            $table->id(); // Auto-incremental primary key
            $table->foreignId('gym_members_id')->constrained('gym_members');
            $table->date('annual_start_date')->nullable(); // Date when the annual membership starts
            $table->date('annual_end_date')->nullable(); // Date when the annual membership ends
            $table->enum('annual_status', ['active', 'cancelled'])->nullable(); // Status of the annual membership
            $table->date('subscription_start_date')->nullable(); // Date when the annual membership starts
            $table->date('subscription_end_date')->nullable(); 
            $table->enum('subscription_status', ['active', 'inactive'])->nullable(); // Status of the subscription for trainings
            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};
