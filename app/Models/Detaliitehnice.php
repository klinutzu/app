<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detaliitehnice extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'detaliitehnices';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'numar_comanda_id',
        'detalii_tehnice_id',
        'link_monitorizare',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function numar_comanda()
    {
        return $this->belongsTo(Comenzi::class, 'numar_comanda_id');
    }

    public function detalii_tehnice()
    {
        return $this->belongsTo(Instalari::class, 'detalii_tehnice_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
