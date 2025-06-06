<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        // $arr = [];
        // $arr [] = $this->user();
        // $arr [] = $this->user;
        // dd($arr);

        // return true;
        return $this->user()->can('update', $this->user);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|min:5|max:40",
            "bio" => "required|min:1|max:255",
            "image" => "image"
            // 'image' => 'image|mimes:jpeg,png|max:2048'
        ];
    }
}
