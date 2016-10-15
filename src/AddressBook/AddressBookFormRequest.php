<?php

namespace Antvel\AddressBook;

use Illuminate\Foundation\Http\FormRequest;

class AddressBookFormRequest extends FormRequest
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
            'line2' => 'max:100',
            'country' => 'required',
            'city' => 'required|string',
            'state' => 'required|string',
            'phone' => 'required|max:20',
            'line1' => 'required|max:100',
            'zipcode' => 'required|min:3',
            'name_contact' => 'required|string|max:60'
          ];
    }
}
