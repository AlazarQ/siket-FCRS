<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Audit;

class Branch extends Model implements AuditableContract
{
    use HasFactory, Auditable;

    protected $fillable = ['branchCode', 'branchName', 'branchLocation', 'branchDistrict', 'branchMnemonic', 'remark', 'createdBy'];

    public function district()
    {
        return $this->belongsTo(District::class, 'branchDistrict', 'districtCode');
    }
}
