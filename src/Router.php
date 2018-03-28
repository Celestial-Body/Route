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

use SplObjectStorage;

/**
 * Router.
 */
class Router extends RouterConstants implements RouterInterface
{

    /**
     * @var array $methods The list of allowed methods.
     */
    private $collections = new SplObjectStorage();
    
    /**
     * @var array $methods The list of allowed methods.
     */
    private $methods = [
        'POST',
        'GET',
        'PUT',
        'DELETE',
        'HEAD',
        'PATCH'
    ];
    
    /**
     * @var string $location The location in which the templates reside.
     */
    private $location = getcwd() . DIRECTORY_SEPARATOR . 'templates';
    
    /**
     * Create a new router.
     *
     * @param array $config     The router config.
     * @param mixed $collection The route collection
     *
     * @return void Return nothing.
     */
    public function __construct(array $config = [], $collection = null)
    {
        if (!empty($config))
        {
            foreach ($config as $key => $value)
            {
                if ($key == 'methods')
                {
                    if (is_array($value))
                    {
                        foreach ($value as $method)
                        {
                            $method = strtoupper($method);
                            $x = 1;
                            if (in_array($method, self::METHODS))
                            {
                                if ($x == 1) {
                                    $this->methods = [];
                                }
                                $this->methods[] = $method;
                                $x++;
                            }                            
                        }
                    }
                }
                if ($key == 'location')
                {
                    if (is_string($value))
                    {
                        $location = str_replace([
                            '\\'
                            '/',
                            ':',
                            ';'
                        ], DIRECTORY_SEPARATOR, $value);
                        $location = explode(\DIRECTORY_SEPARATOR, $location);
                        $pathBuilder = getcwd();
                        foreach ($location as $section)
                        {
                            $pathBuilder .= DIRECTORY_SEPARATOR . basename($section);
                        }
                        if (is_dir($pathBuilder))
                        {
                            $this->location = $pathBuilder;
                        }
                    }
                }
            }
        }
        if (!is_null($collection))
        {
            $this->addCollection($collection);
        }
    }
    
    /**
     * Add a route collection to the router.
     *
     * @param Collection $collection The route collection.
     * @param bool       $discard    Discard the old collection.
     *
     * @return void Return nothing.
     */
    public function addCollection(Collection $collection, bool $discard = false): void
    {
        if (!$discard)
        {
            $this->collections = new SplObjectStorage();
        }
        if (!$this->hasConflicts($collection, $this->collections))
        {
            $this->collections->attach($collection);
        }
    }

    /**
     * Check to see if the collections has conflicts with the current
     * route collections.
     *
     * @param Collection $collection The route collection.
     *
     * @return bool Return TRUE if the collection has conflicts with the current route 
     *              collections and FALSE if it does not.
     */
    private function hasConflicts(Collection $collection): bool
    {
        foreach ($collection->getRouteNames() as $routeNames)
        {
            foreach ($this->collections as $object)
            {
                foreach ($routeNames as $routeName)
                {
                    if ($object->routeEquals($routeNames))
                    {
                        return true;
                    }
                }
            }
        }
        return false;
    }
    
}
