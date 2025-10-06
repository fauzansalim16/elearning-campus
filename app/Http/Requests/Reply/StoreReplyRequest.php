<?php

namespace App\Http\Requests\Reply;

use Illuminate\Foundation\Http\FormRequest;

class StoreReplyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'discussion_id' => ['required', 'integer', 'exists:discussions,id'],
            'content' => ['required', 'string'],
        ];
    }
}



