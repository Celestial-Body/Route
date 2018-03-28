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

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

/**
 * Config.
 */
class Config implements ConfigInterface
{
    
    /**
     * @var array $routeOptions The list of avaliable route options.
     */
    private $routeOptions = [
        'path',
        'controller'
    ];
    
    /**
     * Inject the route configuration with the route configuration instance.
     *
     * @param mixed $configuration The route configuration file or text.
     *
     * @throws Exception\InvalidRouteConfiguration If the route configuration is invalid.
     *
     * @return void Return nothing.
     */
    public function __construct($configuration)
    {
        if (\is_array($configuration)) {
            if (Utils::arrayDepth($configuration) != 2) {
                throw new Exception\InvalidRouteConfiguration(\sprintf(
                    'The route configuration has an invalid array depth. Depth Passed: `%s`.',
                    \strval(Utils::arrayDepth($configuration))
                ));
            }
            foreach ($configuration as $key => $element) {
                if (!\is_array($element)) {
                    throw new Exception\InvalidRouteConfiguration(\sprintf(
                        'The route configuration has an element with a depth of 1. Element Passed: `%s`.',
                        \htmlspecialchars($key, \ENT_QUOTES)
                    ));
                }
                foreach ($element as $routeOption => $value) {
                    if (!\in_array($routeOption, $this->routeOptions) {
                        throw new Exception\InvalidRouteConfiguration(\sprintf(
                            'The route configuration has a route option that is unknown or unsupported. Route Option Passed: `%s`.',
                            \htmlspecialchars($routeOption, \ENT_QUOTES)
                        ));
                    }
                    if (!\is_string($value)) {
                        throw new Exception\InvalidRouteConfiguration(\sprintf(
                            'The route configuration has a route option value that is not a string. Type Passed: `%s`.',
                            \gettype($value)
                        ));
                    }
                }
            }
        }
    }
    
}
