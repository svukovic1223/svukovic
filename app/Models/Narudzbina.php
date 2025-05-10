<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Narudzbina extends Model
{
    use HasFactory;

    protected $table = 'narudzbina';

    protected $fillable = [
        'ime', 
        'proizvod_id', 
        'kolicina', 
        'adresa', 
        'user_id',
        'email', 
        'status',
    ];

    public function proizvod()
    {
        return $this->belongsTo(Proizvod::class);
    }

    public function korisnik()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
