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
     * @param array $config     The router config.
     * @param mixed $collection The route collection
     *
     * @return void Return nothing.
     */
    public function __construct(array $config = [], $collection = null);
    
    /**
     * Add a route collection to the router.
     *
     * @param Collection $collection The route collection.
     * @param bool       $discard    Discard the old collection.
     *
     * @return void Return nothing.
     */
    public function addCollection(Collection $collection, bool $discard = false): void;
    
}
