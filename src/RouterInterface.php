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
 * RouterInterface.
 */
interface RouterInterface
{
    
    /**
     * Create a new router.
     *
     * @param RouteCollection $collection The route collection.
     *
     * @return void Return nothing.
     */
    public function __construct(RouteCollection $collection);
    
    /**
     * Run the router and render a response.
     *
     * @param string $method The request method.
     * @param string $uri    The request uri.
     *
     * @return string The rendered response.
     */
    public function response(string $method, string $uri): string;
    
}
