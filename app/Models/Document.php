<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type_id',
        'brand',
        'serial',
        'sto_id',
        'file',
    ];

    public function deviceType()
    {
        return $this->belongsTo(Dropdown::class, 'type_id');
    }

    public function sto()
    {
        return $this->belongsTo(Dropdown::class, 'sto_id');
    }
}
