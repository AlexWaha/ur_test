<?php
// *	@copyright (c) OCDEV.PRO 2020 - 2022.
// * 	@author 	   Alexander Vakhovskiy (AlexWaha)
// *	@link 		   https://ocdev.pro
// *    @email 		   support@ocdev.pro
// *	@license	   see LICENSE.txt

namespace Tests\Feature;

use App\Models\User;

class UserPostTest extends ActionTestCase
{

    /**
     * @inheritDoc
     */
    public function getRouteName(): string
    {
        return 'user.posts.store';
    }

    public function testUnathorizredUserCanNotCreatePost()
    {
        $data = [
            'title' => 'Test Post Title',
            'description' => 'Lorem ipsum',
            'is_active' => true,
        ];

        $this->callRouteAction($data)
            ->assertStatus(401);
    }

    public function testAuthorizredUserCanCreatePost()
    {
        $data = [
            'title' => 'Test Post Title', //TODO Change to Faker
            'description' => 'Lorem ipsum',
            'is_active' => true,
        ];

        $this->callAuthorizedRouteAction($data)
            ->assertStatus(201)
            ->assertJson(compact('data'));
    }
}