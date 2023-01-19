<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompaniesEditRequest extends FormRequest
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
		
		$rec_id = request()->route('rec_id');

        return [
            
				"name" => "filled|string|unique:companies,name,$rec_id,id",
				"slogan" => "nullable|string",
				"com_phone" => "nullable|string",
				"com_email" => "nullable|email",
				"address" => "nullable",
				"website" => "nullable|string",
				"logo" => "nullable",
				"favicon" => "nullable",
				"signature" => "nullable",
            
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
