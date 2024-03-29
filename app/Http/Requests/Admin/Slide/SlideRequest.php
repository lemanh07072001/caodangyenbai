<?php

namespace App\Http\Requests\Admin\Slide;

use Illuminate\Support\Str;
use App\Rules\Admin\FlileCategoriesRule;
use Illuminate\Foundation\Http\FormRequest;

class SlideRequest extends FormRequest
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
            $rule = [
                'title' => 'required|string|max:255|unique:slides,title,' . $id,
                'categories_id' => 'nullable|numeric',
                'link' => $this->filled('link') ? [function ($attr, $value, $err) {
                    if ($value && request()->categories_id != 0) {
                        $err('Đường dẫn và danh mục chỉ được chọn một!');
                    }
                }, 'required', 'url:http,https'] : '',
                'thumbnail' =>  [new FlileCategoriesRule, 'required'],
                'order' => [function ($attr, $value, $err) {
                    if ($value == '') {
                        $err(':attribute không được để trống!');
                    }
                }],

            ];
        } else {
            $rule = [
                'title' => 'required|string|max:255|unique:slides,title',
                'categories_id' => 'nullable|numeric',
                'link' => $this->filled('link') ? [function ($attr, $value, $err) {
                    if ($value && request()->categories_id != 0) {
                        $err('Đường dẫn và danh mục chỉ được chọn một!');
                    }
                }, 'required', 'url:http,https'] : '',
                'thumbnail' =>  [new FlileCategoriesRule, 'required'],
                'order' => [function ($attr, $value, $err) {
                    if ($value == '') {
                        $err(':attribute phải được chọn!');
                    }
                }],

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
            'categories_id.nullable' => 'Lỗi không xác định',
            'categories_id.numeric' => 'Lỗi không xác định',
            'link.required' => ':attribute không được để trống',
            'link.url' => 'Định dạng không chính xác',
            'thumbnail.required' => ':attribute không được để trống',

        ]; // TODO: Change the autogenerated stub
    }

    public function attributes()
    {
        return [
            'title' => 'Tên slide',
            'categories_id' => 'Danh mục',
            'link' => 'Đường dẫn',
            'thumbnail' => 'Hình ảnh',
            'order' => 'Vị trí',
        ]; // TODO: Change the autogenerated stub
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->title),
        ]);
    }
}
