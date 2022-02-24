<?php
// *	@copyright (c) OCDEV.PRO 2020 - 2022.
// * 	@author 	   Alexander Vakhovskiy (AlexWaha)
// *	@link 		   https://ocdev.pro
// *    @email 		   support@ocdev.pro
// *	@license	   see LICENSE.txt

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'is_active' => 'required|boolean',
        ];
    }
}