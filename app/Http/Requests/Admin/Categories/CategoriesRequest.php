<?php

namespace App\Http\Requests\Admin\Categories;

use App\Rules\Admin\Categories\CategpriesRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CategoriesRequest extends FormRequest
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
        if (!empty(request()->route()->parameters['id'])){
            $id = request()->route()->parameters['id'];
        }

        if (!empty($id)){
            $rule =[
                'title' => 'required|string|max:255|unique:categories,title,'.$id,
                'parent_id' => 'nullable|numeric',
                'type' => [function($attr,$value,$err){
                    if (request()->input('parent_id') != null && $value != null){
                        $err('Vui lòng chọn danh mục là "Danh mục cha"');
                    }
                },'nullable','numeric'],
            ];
        }else{
            $rule =[
                'title' => 'required|string|max:255|unique:categories,title',
                'parent_id' => 'nullable|numeric',
                'type' => [function($attr,$value,$err){
                    if (request()->input('parent_id') != null && $value != null){
                        $err('Vui lòng chọn danh mục là "Danh mục cha"');
                    }
                },'nullable','numeric'],
            ];
        }
        return  $rule;
    }

    public function messages()
    {
        return [
            'title.required' => ':attribute không được để trống',
            'title.string' => ':attribute pahir là kiểu chuỗi',
            'title.max' => ':attribute không được quá :max ký tự',
            'title.unique' => ':attribute đã tồn tại trong hệ thống',
            'type.nullable' => 'Lỗi không xác định',
            'type.numeric' => 'Lỗi không xác định',
            'parent_id.nullable' => 'Lỗi không xác định',
            'parent_id.numeric' => 'Lỗi không xác định'
        ]; // TODO: Change the autogenerated stub
    }

    public function attributes()
    {
        return [
            'title' => 'Tên danh mục',
        ]; // TODO: Change the autogenerated stub
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->title),
        ]);
    }
}