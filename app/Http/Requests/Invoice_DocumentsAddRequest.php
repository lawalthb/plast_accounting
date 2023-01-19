<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Invoice_DocumentsAddRequest extends FormRequest
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
            
				"doc_date" => "required|date",
				"doc_no" => "nullable|string",
				"comment" => "nullable",
				"doc_type" => "required",
				"customer_legder_id" => "required",
				"user_id" => "required",
				"sales_ledger_id" => "required",
				"company_id" => "required",
            
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
