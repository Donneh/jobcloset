<?php

namespace App\Http\Requests;

use App\Models\Department;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateDepartmentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', Rule::unique(Department::class)],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
