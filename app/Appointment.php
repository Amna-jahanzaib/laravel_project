<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Appointment extends Model
{
    use SoftDeletes;

    public $table = 'appointments';
    protected $primaryKey = 'id';


    protected $dates = [
        'start_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const TYPE_RADIO = [
        '0' => 'In-Person Meeting',
        '1' => 'Online Session',
    ];

    const STATUS_SELECT = [
        '0' => 'Pending',
        '1' => 'Accepted',
        '2' => 'Rejected',
        '3' => 'Ready',
        '4' => 'In-Progress',
        '5' => 'Completed',
    ];

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'start_date',
        'start_time',
        'status',
        'appointment_desc',
        'type',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');

    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');

    }

    public function getStartDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;

    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;

    }
    public function sessions()
    {
        return $this->hasMany(Session::class);
    }


}
