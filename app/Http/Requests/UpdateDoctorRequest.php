<?php

namespace App\Http\Requests;

use App\Doctor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateDoctorRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('doctor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'first_name'      => [
                
                'max:20',
                'required'],
            'last_name'       => [
                
                'max:20',
                'required'],
            'username'        => [
                'min:4',
                'required'],
                'date_of_birth'  => [
                    'required'],
        'password' => ['min:8|required_with:confirm_password|same:confirm_password'],
            'confirm_password' => ['min:8'],                      
                'gender'          => [
                'required'],
            'address'         => [
                'required'],
            'notes'         => [
                'required'],
            'skills'         => [
                'required'],
                'department'         => [
                    'required'],
                'city'            => [
                'required'],
            'state'           => [
                'required'],
            'photo'           => [
                'required'],
            'short_biography' => [
                'required'],
            'days'            => [
                'required'],
            'hospital_name'   => [
                'required'],
                'hospital_name'   => [
                    'required'],
            'hospital_days'   => [
                'required'], 
            'hospital_address'   => [
                'required'],
            'hospital_start_timing'   => [
                'required'],
            'hospital_finish_timing'   => [
                'required'],
            'start_timing'   => [
                'required'],
            'finish_timing'   => [
                'required'],
                        

        ];
    }
}
