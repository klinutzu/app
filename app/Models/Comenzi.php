<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Comenzi extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use HasFactory;

    public $table = 'comenzis';

    protected $appends = [
        'fisiere',
    ];

    protected $dates = [
        'data_init',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'initiator_id',
        'presales_id',
        'data_init',
        'nume_client',
        'pers_contact',
        'telefon',
        'adresa',
        'cost_total',
        'cost_lunar',
        'numar_comanda',
        'numar_ariba',
        'observatii',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function initiator()
    {
        return $this->belongsTo(Initiatori::class, 'initiator_id');
    }

    public function presales()
    {
        return $this->belongsTo(Presale::class, 'presales_id');
    }

    public function getDataInitAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDataInitAttribute($value)
    {
        $this->attributes['data_init'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function servicius()
    {
        return $this->belongsToMany(Servicii::class);
    }

    public function getFisiereAttribute()
    {
        return $this->getMedia('fisiere');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
