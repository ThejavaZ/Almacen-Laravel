<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Positions;
class Employees extends Model
{
    protected $fillable = [
        'name',
        'address',
        'email',
        'phone',
        'position_id',
        'active',
        'status'
    ];


    public function position()
    {
        return $this->belongsTo(Positions::class, 'position_id');
    }
}
