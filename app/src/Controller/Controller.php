<?php
/**
 * Base class for all Controllers
 *
 * @category  Controller
 * @package   Slim3 Bootstrap
 * @author    Rónán O'Neill <youcanmailronan@gmail.com>
 * @license   Proprietary
 * @link      N/A
 */

namespace Bootstrap\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use \Slim\Views\Twig;

abstract class Controller implements ControllerInterface
{
    /**
     * Twig templating engine used to render the views
     *
     * @var Slim\Views\Twig Slim's Twig rendering engine
     */
    private $_twigView = [];

    /**
     * The stylesheet stack for the current page
     *
     * @var array
     */
    private $_cssIncludes = [];

    /**
     * The JS stack for the current page
     *
     * @var array
     */
    private $_jsIncludes = [];

    /**
     * Abstract Base Controller Constructor
     *
     * @param Slim\Views\Twig $twigView Slim's Twig rendering engine
     *
     * @return void
     */
    public function __construct(Twig $twigView) {
        // Define the Twig templating engine
        $this->_twigView = $twigView;
        // Include the common stylesheets
        $this->setCssInclude('header');
        $this->setCssInclude('common');
    }

    /**
     * Dispatch a response, useing the template name and data to render the view
     *
     * @param ResponseInterface $response     The Slim Response interface used to define response
     * @param string            $templateName Twig template name
     * @param array             $templateData Date required to render the template
     *
     * @return Slim\Http\Response The rendered Reponse object
     */
    public function dispatch(ResponseInterface $response, $templateName, $templateData = []) {
        // Define any custom, default template data
        $this->_setDefaultTemplateData($templateData);
        // Ensure we've a template name
        if (!empty($templateName)) {
            return $this->_twigView->render($response, $templateName, $templateData);
        }
    }

    /**
     * Define the default data we want to make available to the Twig templates
     *
     * @param array &$templateData The data required for the related view as defined by the model / controller
     *
     * @return void
     */
    private function _setDefaultTemplateData(&$templateData) {
        // Include required stylesheets
        $templateData['cssincludes'] = $this->_cssIncludes;
        // Include required stylesheets
        $templateData['jsincludes'] = $this->_jsIncludes;
    }

    /**
     * Add a CSS file to the stack of stylesheets to be included this page
     *
     * @param string $filename CSS stylesheet filename
     *
     * @return void
     */
    public function setCssInclude($filename) {
        $this->_cssIncludes[] = $filename;
    }

    /**
     * Add a JS file to the stack of JS scripts to be included this page
     *
     * @param string $filename JS filename
     *
     * @return void
     */
    public function setJsInclude($filename) {
        $this->_jsIncludes[] = $filename;
    }
}
