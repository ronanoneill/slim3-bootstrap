<?php
/**
 * Application Dependencies
 *
 * @category Dependencies
 * @package  Slim3 Bootstrap
 * @author   Rónán O'Neill <youcanmailronan@gmail.com>
 * @license  Proprietary
 * @link     N/A
 */

use Interop\Container\ContainerInterface;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Monolog\Handler\StreamHandler;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;

use Bootstrap\Controller\Index as IndexController;
use Bootstrap\Model\Index as IndexModel;

/*
 * ----------------------------------------- Slim
 */

// Define Slim's default settings
$container['settings'] = function (ContainerInterface $c) {
    /*
     * Return the required settings based on current environment, which is
     * handled in the Config private _buildFullPathToIniFile() method
     */
    return [
        'httpVersion' => '1.1'
        , 'responseChunkSize' => 4096
        , 'outputBuffering' => 'append'
        , 'determineRouteBeforeAppMiddleware' => false
        , 'displayErrorDetails' => getenv('SLIM_DISPLAYERRORS')
        ,  'logger' => [
            'name' => 'bootstrap'
            , 'path' => getenv('LOGGER_FILEPATH')
        ]
    ];
};

// Register custom not found / 404 handler
$container['notFoundHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
        return (new ErrorController($c->get('view')))
            ->render404($request, $response)
            ->withStatus(404);
    };
};

// Register custom error / 500 handler (only for production, we want Slim output in dev)
if (!getenv('SLIM_USE_CUSTOM_ERRORHANDLER')) {
    $container['errorHandler'] = function ($c) {
        return function ($request, $response, $exception) use ($c) {
            return (new ErrorController($c->get('view')))
                ->render500($request, $response, $exception)
                ->withStatus(500);
        };
    };
}

/*
 * -------------------------------------------------------------------------- Application Components
 */

$container['view'] = function (ContainerInterface $c) {
    $view = new Twig(
        __DIR__ . '/templates'
        , [
            'cache' => false
            , 'debug' => getenv('TWIG_DEBUG')
            , 'auto_reload' => getenv('TWIG_AUTORELOAD')
        ]
    );
    $view->addExtension(new TwigExtension($c['router'], $c['request']->getUri()));
    $view->addExtension(new Twig_Extensions_Extension_Date());
    $view->addExtension(new Twig_Extension_Debug());
    return $view;
};

$container['logger'] = function (ContainerInterface $c) {
    $settings = $c->get('settings');
    $logger = new Logger($settings['logger']['name']);
    $logger->pushProcessor(new UidProcessor());
    $logger->pushHandler(new StreamHandler($settings['logger']['path'], Logger::DEBUG));
    return $logger;
};

/*
 * ------------------------------------------------------------------------- Middleware
 */

/*
 * ------------------------------------------------------------------------- Controllers
 */

$container['Controller\Error'] = function (ContainerInterface $c) {
    return new ErrorController($c->get('view'));
};

$container['Controller\Index'] = function (ContainerInterface $c) {
    return new IndexController(new IndexModel(), $c->get('view'));
};
