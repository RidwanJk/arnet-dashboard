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
        'first_sto_id',
        'last_sto_id',
        'evidence',
        'ba',
        'status',
        'additional',
    ];

    public function deviceType()
    {
        return $this->belongsTo(Dropdown::class, 'type_id');
    }

    public function stoFirst()
    {
        return $this->belongsTo(Dropdown::class, 'sto_first_id');
    }

    public function stoLast()
    {
        return $this->belongsTo(Dropdown::class, 'sto_last_id');
    }
}
