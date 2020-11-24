<?php
namespace App\Application\Helper;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait Validation
{
    /**
     * @author Mohamed Ahmed
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        $result = ['status' => 'error' ,'data' => implode("<br>" , $validator->errors()->all())];
        throw new HttpResponseException(response()->json($result , 200));
    }
}
