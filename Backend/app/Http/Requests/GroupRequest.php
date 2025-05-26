<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Cho phép request được xử lý
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:groups,name',
            'code' => 'required|string|max:255|unique:groups,code',
            'note' => 'nullable|string',
            'permissions' => 'array', // Đảm bảo permissions là một mảng
            'permissions.*' => 'exists:permissions,name', // Kiểm tra từng quyền có tồn tại không
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên nhóm là bắt buộc.',
            'name.unique' => 'Tên nhóm đã tồn tại.',
            'code.required' => 'Mã nhóm là bắt buộc.',
            'code.unique' => 'Mã nhóm đã tồn tại.',
            'permissions.array' => 'Danh sách quyền phải là một mảng.',
            'permissions.*.exists' => 'Quyền không hợp lệ.',
        ];
    }
}
