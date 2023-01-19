<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Item_LinesAddRequest extends FormRequest
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
            
				"row.*.product_id" => "required",
				"row.*.qty" => "required|numeric",
				"row.*.s_price" => "required|numeric",
				"row.*.amount" => "required|numeric",
				"row.*.p_price" => "required|numeric",
				"row.*.unit" => "nullable|string",
				"row.*.comment" => "nullable|string",
				"row.*.doc_no" => "nullable|numeric",
				"row.*.company_id" => "required",
				"row.*.user_id" => "required",
            
        ];
    }

	public function messages()
    {
        return [
			
            //using laravel default validation messages
        ];
    }

    /**
     *  Filters to be applied to the input.
     *
     * @return array
     */
    public function filters()
    {
        return [
            //eg = 'name' => 'trim|capitalize|escape'
        ];
    }
}
