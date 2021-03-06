<?php

namespace App\Http\Requests;

use App\Patient;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StorePatientRequest extends FormRequest
{
    public function authorize()
    {

        return true;

    }

    public function rules()
    {
        return [
            'name'        => [
                'min:3',
                'required'],
            'father_name' => [
                'min:3',
                'required'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],

                'password_confirmation' => 'required',

                
            'age'         => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647'],
            'email'           => [
                    'required',
                    'unique:users'],
            'password' => ['min:8|required_with:confirm_password|same:confirm_password'],
            'confirm_password' => ['min:8'],                      
        
            'phone'       => [
                'required',
                'unique:patients'],
            'gender'      => [
                'required'],
            'disease'     => [
                'required'],
            'city'        => [
                'required'],
            'country'     => [
                'required'],
            'address'     => [
                'required'],
        ];

    }
}
