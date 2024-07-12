<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dropdown extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'subtype',
    ];

    public function stoMaps()
    {
        return $this->hasMany(Map::class, 'sto_id');
    }

    public function roomMaps()
    {
        return $this->hasMany(Map::class, 'room_id');
    }

    public function stoDocs()
    {
        return $this->hasMany(Document::class, 'sto_id');
    }

    public function typeDocs()
    {
        return $this->hasMany(Document::class, 'dtype_id');
    }
}
