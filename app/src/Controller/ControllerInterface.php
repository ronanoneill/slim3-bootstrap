<?php
/**
 * Interface for all Controllers
 *
 * @category  Controller
 * @package   Slim3 Bootstrap
 * @author    Rónán O'Neill <youcanmailronan@gmail.com>
 * @license   Proprietary
 * @link      N/A
 */

namespace Bootstrap\Controller;

use Psr\Http\Message\ResponseInterface;

interface ControllerInterface
{
    /**
     * Dispatch a response, using the template name and data to render the view
     *
     * @param ResponseInterface $response     PSR-7 Response interface
     * @param string            $templateName Twig template name
     * @param array             $templateData Date required to render the template
     *
     * @return Slim\Http\Response The rendered Reponse object
     */
    public function dispatch(ResponseInterface $response, $templateName, $templateData = []);
}
