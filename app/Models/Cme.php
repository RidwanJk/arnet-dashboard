<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cme extends Model
{
    use HasFactory;

    protected $fillable = [
        'total',
        'underfive',
        'morethanfive',
        'morethanten',
        'type_id',
        'year',
    ];

    public function deviceType()
    {
        return $this->belongsTo(Dropdown::class, 'type_id');
    }
    
}

