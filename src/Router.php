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
     * @var string|null $location The location in which the templates reside.
     */
    private $location = \null;
    
    /**
     * Create a new router.
     *
     * @param RouteCollection|null $collection The route collection.
     *
     * @return void Return nothing.
     */
    public function __construct($collection = null)
    {
        if (!is_null($collection)) {
            $this->collection = $collection;
        } else {
            throw new Exception\RouteException('Could not create a new router.');
        }
    }
    
}
