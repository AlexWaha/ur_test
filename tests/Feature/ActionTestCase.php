<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Routing\Route;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

abstract class ActionTestCase extends TestCase
{

    use DatabaseTransactions;

    /**
     * Testing Rout Name
     * @return string
     */
    abstract public function getRouteName(): string;

    /**
     * @return Route
     */
    private function getRouteByName(): Route
    {
        $routes = \Illuminate\Support\Facades\Route::getRoutes();

        /** @var Route $route */
        $route = $routes->getByName($this->getRouteName());

        if (!$route) {
            $this->fail("Route with name [{$this->getRouteName()}] not found!");
        }

        return $route;
    }

    public function assertRouteContainsMiddleware(...$names)
    {
        $route = $this->getRouteByName();

        foreach ($names as $name) {
            $this->assertContains($name, $route->middleware(), "Route doesn't contain middleware [{$name}]");
        }

        return $this;
    }

    /**
     * Authorized request, creating random
     * @param  array  $data  Request body
     * @param  array  $parameters  Route parameters
     * @param  array  $headers  Request headers
     * @param  array  $scopes
     * @return TestResponse
     */
    protected function callAuthorizedRouteAction(
        array $data = [],
        array $parameters = [],
        array $headers = [],
        array $scopes = []
    ): TestResponse {
        /** @var User $user */
        $user = User::factory()->create();
        $user = User::findOrFail($user->getKey());

        return $this->callAuthorizedByUserRouteAction($user, $data, $parameters, $headers, $scopes);
    }

    /**
     * Request with user
     * @param  User  $user
     * @param  array  $data
     * @param  array  $parameters
     * @param  array  $headers
     * @param  array  $scopes
     * @return TestResponse
     */
    protected function callAuthorizedByUserRouteAction(
        User $user,
        array $data = [],
        array $parameters = [],
        array $headers = [],
        array $scopes = []
    ): TestResponse {
        $this->actingAs($user);

        return $this->callRouteAction($data, $parameters, $headers);
    }

    /**
     * Non-authorize request
     * @param  array  $data  Request body
     * @param  array  $parameters  Route parameters
     * @param  array  $headers  Request headers
     * @return TestResponse
     */
    protected function callRouteAction(array $data = [], array $parameters = [], array $headers = []): TestResponse
    {
        $route = $this->getRouteByName();
        $method = $route->methods()[0];
        $url = route($this->getRouteName(), $parameters);

        return $this->json($method, $url, $data, $headers);
    }
}
