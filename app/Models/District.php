<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class District extends Model implements AuditableContract
{
    use HasFactory, Auditable;

    protected $fillable = ['districtCode', 'districtName', 'remark', 'createdBy'];

    public function branches()
    {
        return $this->hasMany(Branch::class, 'branchDistrict', 'districtCode');
    }
}
