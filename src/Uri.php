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
 * Uri.
 */
class Uri implements UriInterface
{
    
    /**
     * @param array $params The uri parameters.
     */
    private $params = [];
    
    /**
     * Does the request uri match the pattern.
     *
     * @param string $uri     The request uri.
     * @param string $pattern The uri pattern.
     *
     * @return bool Returns TRUE if the uri matches the given route
     *                      and returns FALSE if it does not.
     */
    public function matches($uri, $pattern): bool
    {
        $uri_decode = uri_decode($uri, 'pattern');
        if ($uri_decode == $pattern) {
            $this->setParams($uri);
            return true;
        }
        return false;
    }
    
    /**
     * Set the uri parameters.
     *
     * @param string $uri The request uri.
     *
     * @return void Return nothing.
     */
    private function setParams($uri): void
    {
        $this->params = uri_decode($uri, 'params');
    }
    
    /**
     * Get the uri parameters.
     *
     * @return array The uri parameters.
     */
    public function getRouteParams(): array
    {
        return $this->params;
    }
    
}
