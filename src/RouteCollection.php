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
class RouteCollection implements RouteCollectionInterface, ArrayAccess
{
    
    /**
     * @var array $routes A list of routes.
     */
    private $routes = [];
    
    /**
     * Check to see a route exists.
     *
     * @param string $offset An offset to check for.
     *
     * @return bool Returns TRUE if offset exists and FALSE if it does not.
     */
    public function offsetExists($offset)
    {
        return isset($this->routes[$offset]);
    }
    
}
