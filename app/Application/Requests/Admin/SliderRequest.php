<?php
namespace App\Application\Requests\Admin;

use App\Application\Helper\Validation;
use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
            'name' => 'required|string',
            'order' => 'required',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:20000',
            'video' => 'nullable'
        ];
    }
}
