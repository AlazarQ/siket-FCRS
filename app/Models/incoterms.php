<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Incoterms extends Authenticatable implements AuditableContract
{
    use  Notifiable, Auditable, HasRoles;
    protected $table = 'incoterm_lists';
    protected $fillable = [
        'shortCode',
        'description',
        'status'
    ];
}
