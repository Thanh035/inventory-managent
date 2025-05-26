<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaginationRequest extends FormRequest
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
            // rules cho các query parameter
            'page' => 'nullable|integer|min:1', // Nếu có tham số 'page', phải là số nguyên và tối thiểu là 1
            'per_page' => 'nullable|integer|min:1', // Số bản ghi mỗi trang (mặc định là 10 nếu không có)
            'sort' => 'nullable|string', // Sắp xếp theo chuỗi
            'filter' => 'nullable|string', // Lọc theo chuỗi
        ];
    }

    public function paginationParams()
    {
        return [
            // Lấy tham số 'page' từ request hoặc mặc định là 1
            'page' => $this->input('page', 1),

            // Lấy tham số 'per_page' từ request hoặc mặc định là 10
            'per_page' => $this->input('per_page', 2),

            // Lấy tham số 'sort' từ request hoặc mặc định là 'id,desc'
            'sort' => $this->input('sort', 'id,desc'),

            // Lấy tham số 'filter' từ request hoặc mặc định là rỗng
            'filter' => $this->input('filter', ''),
        ];
    }
}
