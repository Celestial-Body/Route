<?php
declare(strict_types=1);
/**
 * Genial Route.
 *
 * @author  Nicholas English <nenglish0820@outlook.com>.
 *
 * @link    <https://github.com/Genial-Framework/Route> Github repository.
 * @license <https://github.com/Genial-Framework/Route/blob/master/LICENSE> BSD 3-Clause.
 */

namespace Genial\Route;

/**
 * Router.
 */
class Router extends Uri implements RouterInterface
{

    /**
     * @var RouteCollection|null $collections The route collection.
     */
    private $collection = null;
    
    /**
     * @var array $methods The list of allowed methods.
     */
    private $methods = [
        'POST',
        'GET',
        'PUT',
        'DELETE',
        'HEAD',
        'PATCH',
        'OPTIONS'
    ];
    
    /**
     * Create a new router.
     *
     * @param RouteCollection $collection The route collection.
     *
     * @return void Return nothing.
     */
    public function __construct(RouteCollection $collection)
    {
        $this->collection = $collection;
    }
    
    /**
     * Run the router and render a response.
     *
     * @param string $method The request method.
     * @param string $uri    The request uri.
     *
     * @return void Return nothing.
     */
    public function response($method, $uri): array
    {
        $routes = $this->collection->getRoutes;
        foreach ($routes as $routeName => $routeInfo) {
            if ($this->matches($uri, $routeInfo['pattern'])) {
                return (array) call_user_func_array(array($routeInfo['controller'], 'index'), $this->getRouteParams($uri));
            }
        }
        return [];
    }
    
}
