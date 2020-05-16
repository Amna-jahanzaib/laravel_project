<?php

namespace App\Http\Requests;

use App\Session;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreSessionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('session_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'type'           => [
                'required'],
            'time'           => [
                'required',
                ],
            'patient_id'     => [
                'required',
                'integer'],
            'doctor_id'      => [
                'required',
                'integer'],
            'appointment_id' => [
                'required',
                'integer'],
        ];
    }
}
