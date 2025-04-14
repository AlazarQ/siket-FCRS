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
        Schema::create('fcy_requests', function (Blueprint $table) {
            $table->id();
            $table->date('dateOfApplication')->nullable();
            $table->string('applicantName')->nullable();
            $table->string('branchName')->nullable();
            $table->string('applicantAddress')->nullable();
            $table->string('telNumber')->nullable();
            $table->string('phoneNumber')->nullable();
            $table->string('address')->nullable();
            $table->string('NBEAccountNumber')->nullable();
            $table->string('descriptionOfGoodService')->nullable();
            $table->string('currencyType')->nullable();
            $table->decimal('performaAmount', 15, 2)->nullable();
            $table->string('modeOfPayment')->nullable();
            $table->string('shipmentPlace')->nullable();
            $table->string('destinationPlace')->nullable();
            $table->string('incoterms')->nullable();
            $table->string('recordStatus')->nullable(); // default status is pending
            $table->string('applicationStatus')->nullable(); // default status is pending
            $table->string('requestRemarks')->nullable(); // remarks for the request
            $table->string('requestFiles')->nullable(); // files related to the request
            $table->string('createdBy')->nullable(); // user who created the request
            $table->string('updatedBy')->nullable(); // user who updated the request
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fcy_requests');
    }
};
