<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoanRegistrationRequest extends FormRequest
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
            "client.lname" => 'required',
            "client.fname" => 'required',
            "client.mname" => 'required',
            "client.dob" => 'required|date',
            "client.gender" => 'required|in:MALE,FEMALE',
            "client.contact_no" => 'required',
            "client.company" => 'required',
            "client.position" => 'required',
            "client.monthly_salary" => 'required',
            "address.philippine_barangay_id" => 'required',
            "address.street" => 'required',
            "client.area_id" => 'required',

            "co_maker.lname" => 'required',
            "co_maker.fname" => 'required',
            "co_maker.mname" => 'required',
            "co_maker.dob" => 'required|date',
            "co_maker.gender" => 'required|in:MALE,FEMALE',
            "co_maker.contact_no" => 'required',
            "co_maker.company" => 'required',
            "co_maker.position" => 'required',
            "co_maker.monthly_salary" => 'required',
            "co_maker_address.philippine_barangay_id" => 'required',
            "co_maker_address.street" => 'required',

            "beneficiary.lname" => 'required',
            "beneficiary.fname" => 'required',
            "beneficiary.mname" => 'required',
            "beneficiary.dob" => 'required|date',
            "beneficiary.gender" => 'required|in:MALE,FEMALE',
            "beneficiary.relationship_id" => 'required',

            "loan.category_id" => 'required',
            "loan.term_id" => 'required',
            "loan.loan_amount" => 'required|numeric',
            "loan.date_loan" => 'required|date',
            "loan.interest" => 'required|numeric|between:1,100'
        ];
    }

    public function attributes(){
        return [
            "client.lname" => "Client's lastname",
            "client.fname" => "Client's firstname",
            "client.mname" => "Client's middlename",
            "client.dob" => "Client's birthday",
            "client.area_id" => "Area",
            "client.philippine_barangay_id" => "Client's barangay",

            "co_maker.lname" => "Co-maker's lastname",
            "co_maker.fname" => "Co-maker's firstname",
            "co_maker.mname" => "Co-maker's middlename",
            "co_maker.dob" => "Co-maker's birthday",
            "co_maker.philippine_barangay_id" => "Co-maker's barangay",

            "beneficiary.lname" => "Beneficiaries lastname",
            "beneficiary.fname" => "Beneficiaries firstname",
            "beneficiary.mname" => "Beneficiaries middlename",
            "beneficiary.dob" => "Beneficiaries birthday",
            "beneficiary.relationship_id" => "Beneficiaries relationship",

            "loan.category_id" => "Category",
            "loan.term_id" => "Term",

        ];
    }
}
