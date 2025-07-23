<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            // 'news' => 'required|array|min:1',
            'news.*.content' => 'required|string',
            'news.*.image' => $this->isMethod('post')
                ? 'required|image|mimes:jpeg,png,jpg,svg|max:2048'
                : 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title is required.',
            // 'news.required' => 'At least one news item is required.',
            'news.*.content.required' => 'Content is required for each news item.',
            'news.*.image.required' => 'An image is required for each news item when creating new news.',
        ];
    }

}
