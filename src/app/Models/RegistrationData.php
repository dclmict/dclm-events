<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationData extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'email',
        'age',
        'gender',
        'address',
        'bus_stop',
        'phone_number',
        'whatsapp_number',
        'church_member',
        'facebook_username',
        'church',
        'new_comer',
        'location_church',
        'program_id',
        'country_id',
        'state_id',
        'region_id',
        'group_id',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }




}
