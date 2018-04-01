<?php
use ParagonIE\CSPBuilder\CSPBuilder;
use Symfony\Component\Dotenv\Dotenv;

if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
    die('Some composer dependencies are missing, run `composer install` to fix the problem.');
}
require __DIR__ . '/../vendor/autoload.php';

$configuration = file_get_contents(__DIR__ . '/csp_security_policy.json');
if (!is_string($configuration)) {
    throw new Error('Could not read configuration file. Make sure the file exists to fix the problem.');
}
$decoded = json_decode($configuration, true);
if (!is_array($decoded)) {
    throw new Error('Could not parse configuration. Use correct json syntax to fix the problem.');
}
$csp = new CSPBuilder($decoded);
$csp->sendCSPHeader();

header('Content-Type: text/html; charset=utf-8');
header('Referrer-Policy: same-origin');
header('Expect-CT: enforce,max-age=30');
header('Strict-Transport-Security: max-age=30');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');

(new Dotenv())->load(__DIR__ . '/../.env');

require __DIR__ . '/../application.php';

if (!isset($application)) {
    die('There is no application initialized. This never should happen, please contact the webmaster.');
}
$application->run();
