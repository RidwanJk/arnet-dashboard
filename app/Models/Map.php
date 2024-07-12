<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    use HasFactory;

    protected $fillable = [
        'sto_id',
        'room_id',
        'file',
        'converted_image',
    ];

    public function sto()
    {
        return $this->belongsTo(Dropdown::class, 'sto_id');
    }

    public function room()
    {
        return $this->belongsTo(Dropdown::class, 'room_id');
    }
}
