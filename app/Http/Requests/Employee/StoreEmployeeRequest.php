<?php

namespace App\Http\Requests\Employee;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEmployeeRequest extends FormRequest
{
    
    public function authorize()
    {
        return Gate::allows('employee_create');
    }

   
    public function rules()
    {
        return [
            'empId' => [
                'string',
                'required',
            ],
            'first_name' => [
                'string',
                'required',
                'min:3'
            ],
            'last_name' => [
                'string',
                'required',
                'min:3'
            ],
            'gender' => [
                'string',
                'required'
            ],
            'eligible' => [
                'string',
                'required'
            ],
            'hire_date' => [
                'date',
                'required'
            ],
            

        ];
    }
}
