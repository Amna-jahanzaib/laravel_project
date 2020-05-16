<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Treatment_Record extends Model
{
    use SoftDeletes;

    public $table = 'treatment_records';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'exercise_id',
        'session_id',
        'problem_diagnosed',
        'recommended_medicine',
        'improvements',
        'next_session_date',
        'next_session_time',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    public function getNextSessonDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d', $value)->format(config('panel.date_format') ) : null;
    }

    public function setNextSessonDateAttribute($value)
    {
        $this->attributes['next_session_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
    public function getNextSessonTimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('H:i', $value)->format( config('panel.time_format')) : null;
    }

    public function setNextSessonTimeAttribute($value)
    {
        $this->attributes['next_session_time'] = $value ? Carbon::createFromFormat( config('panel.time_format'), $value)->format('H:i') : null;
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class, 'exercise_id');
    }

    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }}
