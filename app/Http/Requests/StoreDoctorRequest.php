<?php

namespace App\Http\Requests;
use App\Doctor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreDoctorRequest extends FormRequest
{
    public function authorize()
    {

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
            'email'           => [
                'required',
                'unique:users'],
                'date_of_birth'  => [
                    'required'],
                    'password' => ['min:8|required_with:confirm_password|same:confirm_password'],
                    'confirm_password' => ['min:8'],                      
                'gender'          => [
                'required'],
            'address'         => [
                'required'],
            'education'         => [
                'required'],
            'city'            => [
                'required'],
            'state'           => [
                'required'],
            'phone'           => [
                'required',
                'unique:doctors'],
            'photo'           => [
                'required'],
            'qualification'   => [
                'required'],
            'department'      => [
                'required'],
            'experience'      => [
                'required'],
            'short_biography' => [
                'required'],
            'skills'         => [
                'required'],
            'notes'         => [
                'required'],

            'days'            => [
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
                'documents.*'     => [
                    'required'],

        ];

    }
}
