<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;

    protected $table = 'data_inves';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_inves', 'harga', 'harga_sebelumnya'
    ];

    public $timestamps = false;

    public function getHargaSebelumnyaAttribute($value)
    {
        return $value ?? $this->getOriginal('harga');
    }

    public function setHargaSebelumnya()
    {
        $this->harga_sebelumnya = $this->getOriginal('harga');
    }
}


