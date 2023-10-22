<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = "Mahasiswa";

    protected $fillable = [
        'name', 'nim', 'id_kelas','id_prodi','nohp','email','username','password','image',
    ]; 
    
    public function kelas(){
        return $this->hasOne(Kelas::class,'id','id_kelas');
    }

    public function prodi(){
        return $this->hasOne(Prodi::class,"id", "id_prodi");
    }

}
