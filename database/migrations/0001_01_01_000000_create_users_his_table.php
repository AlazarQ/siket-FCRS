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
        Schema::create('users_his', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('userName')->nullable();
            $table->string('userBranch')->nullable();
            $table->string('userDistrict')->nullable();
            $table->string('userGender')->nullable();
            $table->string('userPhone')->nullable();
            $table->string('userStatus')->nullable();
            $table->string('recordStatus')->nullable();
            $table->string('userRole')->nullable();
            $table->string('remark')->nullable();
            $table->string('createdBy')->nullable();
            $table->rememberToken()->nullable();
            $table->timestamps();
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
