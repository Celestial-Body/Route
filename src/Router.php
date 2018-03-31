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
class Router implements RouterInterface
{

    /**
     * @var RouteCollection|null $collections The route collection.
     */
    private $collection = null;
    
    /**
     * @var Uri|null $collections The route collection.
     */
    private $uri = null;

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
        $this->uri = new Uri();
    }
    
    /**
     * Run the router and render a response.
     *
     * @param string $method The request method.
     * @param string $uri    The request uri.
     *
     * @throws Exception\ControllerNotFoundException If the route controller was not found.
     * @throws Exception\NoControllerSetException If the route controller was not set.
     * @throws Exception\RouteNotFoundException If the route was not found.
     *
     * @return string The rendered response.
     */
    public function response(string $method, string $uri): string
    {
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);
        $routes = $this->collection->getRoutes;
        foreach ($routes as $routeName => $routeInfo) {
            if ($this->uri->matches($uri, $routeInfo['path']) && $method == $routeInfo['method']) {
                if (isset($routeInfo['controller'])) {
                    if (is_callable($routeInfo['controller'])) { 
                        return (string) call_user_func_array($routeInfo['controller'], $this->uri->getRouteParams($uri));
                    }
                    throw new Exception\ControllerNotFoundException('Route controller was not found.');
                }
                throw new Exception\NoControllerSetException('Route controller was not set.');
            }
        }
        throw new Exception\RouteNotFoundException('The route was not found.');
    }
    
}
