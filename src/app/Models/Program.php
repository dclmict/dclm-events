<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image_location'
    ];

    public function getRegistrationData()
    {
        return $this->hasMany(RegistrationData::class, 'program_id', 'id');
    }
    public function getCountryData()
    {
        return $this->belongsTo(Country::class);
    }
    public function getStateData()
    {
        return $this->belongsTo(State::class);
    }
    public function getRegionData()
    {
        return $this->belongsTo(Region::class);
    }
    public function getGroupData()
    {
        return $this->belongsTo(Group::class);
    }
}
