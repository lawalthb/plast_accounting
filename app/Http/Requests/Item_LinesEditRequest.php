<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Item_LinesEditRequest extends FormRequest
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
            
				"product_id" => "filled",
				"qty" => "filled|numeric",
				"s_price" => "filled|numeric",
				"amount" => "filled|numeric",
				"p_price" => "filled|numeric",
				"unit" => "nullable|string",
				"comment" => "nullable|string",
				"doc_no" => "nullable|numeric",
				"company_id" => "filled",
				"user_id" => "filled",
            
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
