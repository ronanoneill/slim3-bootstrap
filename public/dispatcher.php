<?php
/**
 * Public Dispatcher
 *
 * @category  Dispatcher
 * @package   Slim3 Bootstrap
 * @author    Rónán O'Neill <youcanmailronan@gmail.com>
 * @license   Proprietary
 * @link      N/A
 */

// Handle UTF-8 encoding
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');

// Start the session
session_name('bootstrap');
session_start();

// Include Composer's autoload
require '../vendor/autoload.php';

// Load the require environment variables via Dotenv
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/../');
$dotenv->load();

// Register dependencies / DI Container
$container = new \Slim\Container();
require __DIR__ . '/../app/container.php';

// Create a new instance of the Slim app
$app = new \Slim\App($container);

// Register Middleware, Routes
require __DIR__ . '/../app/middleware.php';
require __DIR__ . '/../app/routes.php';

// Run the application
$app->run();
