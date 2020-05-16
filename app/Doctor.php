<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

use \DateTimeInterface;

class Doctor extends Model  implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'doctors';

    protected $appends = [
        'photo',
        'documents',
    ];
    protected $casts = [
        'days' => 'array', // Will convarted to (Array)
        'hospital_days' => 'array', // Will convarted to (Array)
    ];
    
    const GENDER_RADIO = [
        'm' => 'Male',
        'f' => 'Female',
    ];

    protected $dates = [
        'date_of_birth',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const DAYS_SELECT = [
        '0'    => 'Monday',
        '1'   => 'Tuesday',
        '2' => 'Wednesday',
        '3'  => 'Thursday',
        '4'    => 'Friday',
        '5'  => 'Saturday',
        '6'    => 'Sunday',
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'date_of_birth',
        'gender',
        'address',
        'country',
        'city',
        'state',
        'phone',
        'education',
        'notes',
        'skills',
        'qualification',
        'department',
        'experience',
        'short_biography',
        'days',
        'hospital_name',
        'hospital_days',
        'is_registered',
        'user_id',
        'start_timing',
        'finish_timing',
        'hospital_start_timing',
        'hospital_finish_timing',
        'hospital_address',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);

    }

    public function doctorAppointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id', 'id');

    }
  
    public function doctorPayments()
    {
        return $this->hasMany(Payment::class, 'doctor_id', 'id');
    }


    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public function getDateOfBirthbAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;

    }

    public function setDateOfBirthbAttribute($value)
    {
        $this->attributes['dob'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;

    }

    public function getPhotoAttribute()
    {
        $file = $this->getMedia('photo')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
        }

        return $file;

    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');

    }
    public function getAge(){
        $this->date_of_birth->diff($this->attributes['date_of_birth'])
        ->format('%y years, %m months and %d days');
    }

    public function getDocumentsAttribute()
    {
        return $this->getMedia('documents');

    }


}
