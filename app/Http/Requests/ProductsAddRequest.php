<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsAddRequest extends FormRequest
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
            
				"category" => "required",
				"name" => "required|string",
				"unit" => "nullable",
				"qty" => "required|numeric",
				"selling_price" => "required|numeric",
				"purchase_price" => "required|numeric",
				"dead_stock" => "required",
				"is_active" => "required",
				"user_id" => "required",
				"exp_date" => "nullable|date",
				"mfg_date" => "nullable|date",
				"image" => "nullable",
            
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
