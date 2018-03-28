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
use SplObjectStorage;

/**
 * Collection.
 */
class Collection implements CollectionInterface, ArrayAccess
{
    
    /**
     * @var SplObjectStorage $routeControllers The route controllers. 
     */
    private $routeControllers = new SplObjectStorage();
    
    /**
     * @var array $routeNames The route names.
     */
    private $routeNames = [];
    
    /**
     * @var array $routeIds The route ids.
     */
    private $routeIds = [];
    
}
