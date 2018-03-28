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

use ArrayAccess;

/**
 * RouteCollection.
 */
class RouteCollection extends Parser implements RouteCollectionInterface, ArrayAccess
{
    
    /**
     * @var array $methods A list of methods.
     */
    private $methods = [
        'GET',
        'POST',
        'PATCH',
        'PUT',
        'HEAD',
        'DELETE',
        'OPTIONS'
    ];
    
    /**
     * @var array $routes A list of routes.
     */
    private $routes = [];
    
    /**
     * Check to see a route exists.
     *
     * @param mixed $offset An offset to check for.
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function offsetExists($offset)
    {
        return isset($this->routes[$offset]);
    }
    
    /**
     * Add a new route.
     *
     * @param string $name       The route name.
     * @param string $method     The HTTP method for this route.
     * @param string $location   The route location.
     * @param string $controller The route controller.
     *
     * @throws Exception\RouteNameEmptyException     If the route name is empty.
     * @throws Exception\RouteNameDuplicateException If the route name already exists.
     * @throws Exception\MethodNotFoundException     If the method is not found or is unsupported.
     * @throws Exception\LocationUnkownException     If the location parser could not reconcile the given
     *                                               route location.
     * @throws Exception\NoControllerSetException    If the route controller is empty.
     * @throws Exception\ControllerNotFoundException If the controller could not be found.
     *
     * @return bool Returns TRUE on success and FALSE on failure.
     */
    public function addRoute(
        string $name,
        string $method,
        string $location,
        string $controller
    ): bool {
        if (trim($name) == '') {
            throw new Exception\RouteNameEmptyException('The route name is empty.');
        } elseif (isset($this->routes[$name])) {
            throw new Exception\RouteNameDuplicateException('This route name already exists.');
        } elseif (!in_array(strtoupper($method), $this->methods)) {
            throw new Exception\MethodNotFoundException('The route method is not found or is not supported.');
        } elseif (!$this->validSyntax($location)) {
            throw new Exception\LocationUnkownException('The location parser could not reconcile the given route location.');
        } elseif (trim($controller) == '') {
            throw new Exception\NoControllerSetException('The route controller is empty.');
        } elseif (!class_exists($controller)) {
            throw new Exception\ControllerNotFoundException('The route controller could not be found.');
        } else {
            $this->routes[$name] = [
                'method' => $method,
                'location' => $location,
                'controller' => $controller
            ];
        }
    }

}
