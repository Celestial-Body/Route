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
 * RouteCollectionInterface.
 */
interface RouteCollectionInterface
{

    /**
     * Adds a new route.
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
    ): bool;
    
    /**
     * Remove a route.
     *
     * @param string $name The route name.
     *
     * @throws Exception\RouteNameEmptyException If the route name is empty.
     * @throws Exception\RouteNotFoundException  If the route name was not found.
     *
     * @return bool Returns TRUE on success and FALSE on failure.
     */
    public function removeRoute(
        string $name
    ): bool;

}
