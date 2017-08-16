<?php
/**
 * Configuration builds an object that holds the information from an ini file
 *
 * @category  Middleware
 * @package   Slim3 Bootstrap
 * @author    Rónán O'Neill <youcanmailronan@gmail.com>
 * @license   Proprietary
 * @link      N/A
 */

namespace Bootstrap\Middleware;

use \Monolog\Logger;

class Timer
{
    /**
     * Monolog logger client
     *
     * @var \Monolog\Logger
     */
    private $_logger;

    /**
     * \Middleware\Timer Constructor
     *
     * @param Monolog\Logger $logger Monolog logger client
     */
    public function __construct(Logger $logger) {
        $this->_logger = $logger;
    }

    /**
     * Timer middleware invokable class
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param callable                                 $next     Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke($request, $response, $next) {
        $timePre = microtime(true);
        $response = $next($request, $response);
        $timePost = microtime(true);
        $this->_logger->info("Render time:" . ($timePost - $timePre));
        return $response;
    }
}
