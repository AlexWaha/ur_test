<?php
// *	@copyright (c) OCDEV.PRO 2020 - 2022.
// * 	@author 	   Alexander Vakhovskiy (AlexWaha)
// *	@link 		   https://ocdev.pro
// *    @email 		   support@ocdev.pro
// *	@license	   see LICENSE.txt

namespace App\Http\Responses;

use App\Models\Post;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Post $resource
 */
class UserPostResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'description' => $this->resource->description,
            'is_active' => $this->resource->is_active,
        ];
    }
}