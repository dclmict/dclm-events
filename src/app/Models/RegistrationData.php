<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationData extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'age',
        'gender',
        'address',
        'city',
        'bus_stop',
        'phone',
        'whatsapp',
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

    protected $appends = [
        'full_name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
        // return $this->belongsTo(Program::class, 'referrer_id', 'id')
        return $this->belongsTo(Program::class)
        ->orWhere(function ($query) {
            $query->where('program_id','LIKE %'. $this->id. '%');
        });
        // ->with('user');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id','iso2');
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

        /**
     * Get the user's fullname.
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' .$this->last_name;
    }



}
