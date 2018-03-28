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
 * RouterConstants.
 */
class RouterConstants
{

    /**
     * @var array $methods The list of all methods.
     */
    const METHODS = [
        'GET',
        'POST',
        'PATCH',
        'DELETE',
        'PUT',
        'HEAD',
        'OPTIONS',
        'CONNECT'
    ];

}
