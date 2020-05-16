<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Patient extends Model
{
    use SoftDeletes;

    public $table = 'patients';
    protected $primaryKey = 'id';

    const GENDER_RADIO = [
        'm' => 'Male',
        'f' => 'Female',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'father_name',
        'age',
        'phone',
        'gender',
        'disease',
        'city',
        'country',
        'address',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public function patientAppointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id', 'id');

    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');

    }
    public function patientSessions()
    {
        return $this->hasMany(Session::class, 'patient_id', 'id');

    }

    
}
