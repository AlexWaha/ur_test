<?php
// *	@copyright (c) OCDEV.PRO 2020 - 2022.
// * 	@author 	   Alexander Vakhovskiy (AlexWaha)
// *	@link 		   https://ocdev.pro
// *    @email 		   support@ocdev.pro
// *	@license	   see LICENSE.txt

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\ActionTestCase;

class IssueTokenTest extends ActionTestCase
{
    use WithFaker;

    /**
     * @inheritDoc
     */
    public function getRouteName(): string
    {
        return 'tokens.issue';
    }

    public function testUserCanNotGetTokenWithInvalidCredentionals()
    {
        $data = [
            'email' => 'test@admin.com',
            'password' => '12345',
            'device_name' => 'client',
        ];

        $this->callRouteAction($data)
            ->assertStatus(422);
    }

    public function testUserCanGetTokenWithValidCredentionals()
    {
        $data = [
            'email' => $this->faker->email,
            'password' => $this->faker->password,
            'device_name' => 'client',
        ];

        User::factory()->create([
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        $this->callRouteAction($data)
            ->assertStatus(200);
    }

    public function testCredentinalsAreRequired()
    {
        $this->callRouteAction([])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email', 'password', 'device_name']);
    }
}