<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gym_members', function (Blueprint $table) {
            $table->id(); // Auto-incremental primary key
            $table->string('first_name');
            $table->string('last_name');
            $table->string('contact_number')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('members_code')->unique(); // Add 'members_code' field
            // $table->enum('annual', ['active', 'inactive'])->default('inactive')->nullable();
            // $table->enum('subscription_status', ['active', 'inactive'])->default('inactive');
            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gym_members');
    }
};
