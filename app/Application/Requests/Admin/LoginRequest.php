<?php
namespace App\Application\Requests\Admin;

use App\Application\Helper\Validation;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    use Validation;

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
            'email' => 'required|string',
            'password' => 'required|string',
        ];
    }


}
