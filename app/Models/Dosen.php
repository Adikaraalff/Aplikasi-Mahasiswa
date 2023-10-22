<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    protected $table = "Dosen";

    protected $fillable = [
        'name', 'nip', 'id_prodi', 'nohp', 'email', 'alamat', 'image',
    ];

    public function prodi(){
        return $this->hasOne(Prodi::class,"id", "id_prodi");
    }
}
