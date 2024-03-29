<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Support\Str;
use App\Rules\Admin\FlileCategoriesRule;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        $id = null;
        if (request()->route()->id) {
            $id = request()->route()->id;
        }

        if (!empty($id)) {
            $rule =  [
                'title' => 'required|max:255|string|unique:posts,title,' . $id,
                'categories_id' => 'nullable|numeric',
                'description' => 'required',
                'slug' => 'required',
                'thumbnail' =>  [new FlileCategoriesRule, 'required'],

            ];
        } else {
            $rule =  [
                'title' => 'required|max:255|string|unique:posts,title',
                'categories_id' => 'nullable|numeric',
                'description' => 'required',
                'slug' => 'required',
                'thumbnail' =>  [new FlileCategoriesRule, 'required'],

            ];
        }

        return  $rule;
    }

    public function messages()
    {
        return [
            'title.required' => ':attribute không được để trống',
            'title.string' => ':attribute phải là kiểu chuỗi',
            'title.max' => ':attribute không được quá :max ký tự',
            'title.unique' => ':attribute đã tồn tại trong hệ thống',
            'description.required' => ':attribute không được để trống',
            'categories_id.nullable' => 'Lỗi không xác định',
            'categories_id.numeric' => 'Lỗi không xác định',
            'thumbnail.required' => ':attribute không được để trống',
            'slug.required' => ':attribute không được để trống',

        ]; // TODO: Change the autogenerated stub
    }

    public function attributes()
    {
        return [
            'title' => 'Tên slide',
            'thumbnail' => 'Hình ảnh',
            'description' => 'Mô tả'
        ]; // TODO: Change the autogenerated stub
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->title),
        ]);
    }
}