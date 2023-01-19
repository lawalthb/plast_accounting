<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Companiesuser_addRequest extends FormRequest
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
            
				"name" => "required|string|unique:companies,name",
				"slogan" => "nullable|string",
				"com_phone" => "nullable|string",
				"com_email" => "nullable|email",
				"address" => "nullable",
				"website" => "nullable|string",
				"logo" => "nullable",
				"favicon" => "nullable",
            
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
