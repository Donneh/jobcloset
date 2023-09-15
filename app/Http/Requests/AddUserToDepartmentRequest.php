<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserToDepartmentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|string|max:255',
//            'department_id' => 'required|exists:departments,id',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
