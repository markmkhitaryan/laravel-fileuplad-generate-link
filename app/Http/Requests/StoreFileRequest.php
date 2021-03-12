<?php

namespace App\Http\Requests;

use App\Rules\FileExceptType;
use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends FormRequest
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
            'file' => ['required', 'fileExceptType'=>new FileExceptType(['php','exe','bmp']), 'max:10240    '],

        ];
    }
    public function messages()
    {
        return [
            'file.required' => "You must use the 'Choose file' button to select which file you wish to upload",
            'file.size' => "Maximum file size to upload is 10MB ",
        ];
    }
}
