<?php
/**
 * Error Controller
 *
 * @category Controller
 * @package  Slim3 Bootstrap
 * @author   Rónán O'Neill <youcanmailronan@gmail.com>
 * @license  Proprietary
 * @link     N/A
 */

namespace Bootstrap\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Views\Twig;

class Error extends Controller
{
    /**
     * Error Controller Constructor
     *
     * @param \Slim\Views\Twig $view  Slim's Twig template engine
     *
     * @return void
     */
    public function __construct(Twig $view) {
        // Construct abstract parent Controller
        parent::__construct($view);
    }

    /**
     * Render the 404 view
     *
     * @param ServerRequestInterface $request  PSR-7 Request interface
     * @param ResponseInterface      $response PSR-7 Response interface
     *
     * @return Slim\Http\Response The rendered Reponse object
     */
    public function render404(ServerRequestInterface $request, ResponseInterface $response) {
        // Dispatch the homepage template request
        return parent::dispatch($response, '40x.twig');
    }

    /**
     * Render the 500 view
     *
     * @param ServerRequestInterface $request   PSR-7 Request interface
     * @param ResponseInterface      $response  PSR-7 Response interface
     * @param Exception              $exception The thrown Exception
     *
     * @return Slim\Http\Response The rendered Reponse object
     */
    public function render500(ServerRequestInterface $request, ResponseInterface $response) {
        // Dispatch the homepage template request
        return parent::dispatch($response, '50x.twig');
    }
}
