<?php

namespace App\Http\Requests\Label;

use Override;
use App\Models\Label;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLabelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var Label $label */
        $label = $this->route('label');

        return [
            'name'        => [
                'required',
                'max:50',
                Rule::unique(Label::class)->ignore($label->id),
            ],
            'description' => ['nullable'],
        ];
    }

    #[Override]
    public function messages(): array
    {
        return [
            'name.required' => trans('validation.label.required'),
            'name.unique'   => trans('validation.label.unique'),
        ];
    }
}
