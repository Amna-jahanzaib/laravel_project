<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Session extends Model
{
    use SoftDeletes;

    public $table = 'sessions';

    protected $dates = [
        'time',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const TYPE_SELECT = [
        '0' => 'In-Person Meeting',
        '1' => 'Online Session',
    ];
    const STATUS_SELECT = [
        '0' => 'Pending',
        '1' => 'Accepted',
        '2' => 'Rejected',
        '3' => 'Ready',
        '4' => 'In Progress',
        '5' => 'Completed',
    ];

    protected $fillable = [
        'type',
        'time',
        'patient_id',
        'doctor_id',
        'appointment_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i');
    }


    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }


    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }
    public function sessionTreatments()
    {
        return $this->hasOne(Treatment_Record::class, 'session_id', 'id');

    }
}
