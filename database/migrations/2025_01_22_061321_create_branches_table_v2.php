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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('branchCode')->unique();
            $table->string('branchName');
            $table->string('branchLocation');
            $table->string('branchDistrict');
            $table->string('branchMnemonic')->nullable();
            $table->string('remark')->nullable();
            $table->string('createdBy');
            $table->timestamps();

            $table->foreign('branchDistrict')->references('districtCode')->on('districts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
