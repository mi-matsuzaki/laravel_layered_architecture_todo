<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status'      => ['required', 'in:pending,completed'],
            'priority'    => ['required', 'in:low,medium,high'],
            'due_date'    => ['nullable', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'タイトルは必須です。',
            'title.max'      => 'タイトルは255文字以内で入力してください。',
            'status.in'      => 'ステータスは pending / completed のいずれかを選択してください。',
            'priority.in'    => '優先度は low / medium / high のいずれかを選択してください。',
            'due_date.date'  => '期日は正しい日付形式で入力してください。',
        ];
    }
}
