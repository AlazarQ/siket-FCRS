<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FCY_Request extends Model
{
    use HasFactory;
    protected $table = 'fcy_requests';
    // The primary key is 'id' by default, so we don't need to specify it unless it's different.

    protected $fillable = [
        'id',
        'dateOfApplication',
        'applicantName',
        'branchName',
        'applicantAddress',
        'telNumber',
        'phoneNumber',
        'address',
        'NBEAccountNumber',
        'descriptionOfGoodService',
        'currencyType',
        'performaAmount',
        'modeOfPayment',
        'shipmentPlace',
        'destinationPlace',
        'incoterms',
        'recordStatus',
        'applicationStatus',
        'requestRemarks',
        'requestFiles',
        'createdBy', // user who created the request
        'updatedBy', // user who updated the request
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public $timestamps = true;
}
