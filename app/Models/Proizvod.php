<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proizvod extends Model
{
    use HasFactory;

    protected $table = 'proizvodi';

    protected $fillable = [
        'naziv',
        'opis',
        'cena',
        'istaknuto',
        'slika',
    ];

    public function kategorija()
    {
        return $this->belongsTo(Kategorija::class);
    }
}
