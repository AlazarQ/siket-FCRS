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
            $table->string('idReference');
            $table->date('dateOfApplication')->nullable();
            $table->string('applicantName')->nullable();
            $table->string('branchName')->nullable();
            $table->string('applicantAddress')->nullable();
            $table->string('telNumber')->nullable();
            $table->string('phoneNumber')->nullable();
            $table->string('address')->nullable();
            $table->string('NBEAccountNumber')->nullable();
            $table->string('tinNumber')->nullable();
            $table->string('performaInvoiceNumber')->nullable();
            $table->string('itemName')->nullable();
            $table->string('itemQuantity')->nullable();
            $table->string('itemHSCode')->nullable();
            $table->string('descriptionOfGoodService')->nullable();
            $table->string('currencyType')->nullable();
            $table->decimal('performaAmount', 15, 2)->nullable();
            $table->date('performaDate')->nullable();
            $table->string('modeOfPayment')->nullable();
            $table->string('shipmentPlace')->nullable();
            $table->string('destinationPlace')->nullable();
            $table->string('incoterms')->nullable();
            $table->string('recordStatusRegistration')->nullable();
            $table->string('recordStatusAllocation')->nullable();
            $table->string('applicationStatus')->nullable();
            $table->string('requestRemarks')->nullable();
            $table->string('requestFiles')->nullable();
            $table->string('createdBy')->nullable();
            $table->string('updatedBy')->nullable();
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
