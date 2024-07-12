<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'device',
        'tyoe_id',
        'brand',
        'serial',
        'sto_id',
    ];

    public function deviceType()
    {
        return $this->belongsTo(Dropdown::class, 'dtype_id');
    }

    public function sto()
    {
        return $this->belongsTo(Dropdown::class, 'sto_id');
    }
}
