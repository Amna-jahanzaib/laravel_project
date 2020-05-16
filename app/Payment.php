<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Payment extends Model
{
    use SoftDeletes;

    public $table = 'payments';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'doctor_id',
        'patient_id',
        'appointment_id',
        'type',
        'payment_amount',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');

    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');

    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');

    }
}
