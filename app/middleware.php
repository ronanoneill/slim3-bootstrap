<?php
/**
 * Application Middleware
 *
 * @category Middleware
 * @package  Slim3 Bootstrap
 * @author   Rónán O'Neill <youcanmailronan@gmail.com>
 * @license  Proprietary
 * @link     N/A
 */

use Bootstrap\Middleware\Timer;

// Timer
$app->add(new Timer($container['logger']));
