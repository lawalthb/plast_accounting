<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Invoice_DocumentsEditRequest extends FormRequest
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
            
				"doc_date" => "filled|date",
				"doc_no" => "nullable|string",
				"comment" => "nullable",
				"doc_type" => "filled",
				"customer_legder_id" => "filled",
				"user_id" => "filled",
				"sales_ledger_id" => "filled",
				"company_id" => "filled",
				"status" => "filled|numeric",
            
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
