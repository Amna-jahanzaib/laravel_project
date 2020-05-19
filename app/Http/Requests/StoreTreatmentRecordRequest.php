<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTreatmentRecordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'exercise_id' => [
                'required',
                'integer'],
            'session_id'  => [
                'required','unique:treatment_records',
                'integer'],

            'problem_diagnosed'  => [
                'required'],
            'recommended_medicine'  => [
                'required'],
            'improvements'  => [
                'required'],

                
        ];

    }
}
