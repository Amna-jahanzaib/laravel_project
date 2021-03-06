<?php

namespace App\Http\Requests;

use App\Appointment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreAppointmentRequest extends FormRequest
{
    public function authorize()
    {

        return true;
    }

    public function rules()
    {
        return [
            'patient_id'       => [
                'required',
                'integer'],
            'doctor_id'        => [
                'required',
                'integer'],
            'start_date'       => [
                'required',
                'date_format:' . config('panel.date_format')],
            'start_time'       => [
                'required',
                'date_format:' . config('panel.time_format')],
            'appointment_desc' => [
                'required'],
            'type'             => [
                'required'],
        ];

    }
}
