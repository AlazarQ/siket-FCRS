<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class settings extends Authenticatable implements AuditableContract
{
    use  Notifiable, Auditable, HasRoles;
    protected $table = 'settings';
    protected $fillable = [
        'shortCode',
        'description',
        'value',
        'status'
    ];
}
