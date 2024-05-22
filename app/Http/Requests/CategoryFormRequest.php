<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class CategoryFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string',
            'image' => [],
            'description' => 'required|string',
            'status' => 'required',
        ];

        $category = $this->route("category", false);

        if ($category) {

            //validation rules for image if it exists
            if ($this->hasFile("image")) {
                $rules['image'] = [ "required" , File::image()->max(1024) ];
            }
        }else{
            $rules['image'] = [ "required" , File::image()->max(1024) ];
        }
        return $rules;

    }


    public function getData(): array
    {
        $data = $this->except(["_token", "_method", "image"]);
        if ($this->hasFile('image')) {
            $data['image'] = basename($this->file('image')->store(config('system.upload_path')));
        }
        return $data;
    }
}
