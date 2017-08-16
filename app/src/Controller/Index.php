<?php
/**
 * Index Controller
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
use Slim\Views\Twig;

use Bootstrap\Model\Index as IndexModel;

class Index extends Controller
{
    /**
     * The Model object for the current Controller
     *
     * @var Index
     */
    private $_model;

    /**
     * Index Controller Constructor
     *
     * @param Index $model The Index model required by this controller
     * @param Twig  $view  Slim's Twig template engine
     *
     * @return void
     */
    public function __construct(DashboardModel $model, Twig $view) {
        // Construct abstract parent Controller
        parent::__construct($view);
        // Define the model
        $this->_model = $model;
    }

    /**
     * Render the Dashboard index view
     *
     * @param ServerRequestInterface $request  PSR-7 Request interface
     * @param ResponseInterface      $response PSR-7 Response interface
     *
     * @return Slim\Http\Response The rendered Reponse object
     */
    public function index(ServerRequestInterface $request, ResponseInterface $response) {
        // Include required static assets, etc,

        // Dispatch the Dashboard template request
        return parent::dispatch($response, 'index.twig', $this->_model->pageRenderData());
    }
}
