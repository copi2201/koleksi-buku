<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku'; // Sesuaikan dengan nama tabel di DB [cite: 32]
    protected $primaryKey = 'idbuku'; // Sesuaikan dengan ER Diagram [cite: 34]
    public $timestamps = false;
   
    protected $fillable = [
        'kode', 
        'judul', 
        'pengarang', 
        'idkategori'
    ];

    // Relasi ke Kategori sesuai ER Diagram [cite: 31, 38]
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'idkategori', 'idkategori');
    }
}