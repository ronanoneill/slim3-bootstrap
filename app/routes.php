<?php
/**
 * Application Routes
 *
 * @category Routes
 * @package  Slim3 Bootstrap
 * @author   Rónán O'Neill <youcanmailronan@gmail.com>
 * @license  Proprietary
 * @link     N/A
 */

// Index
$app->get('/', 'Controller\Index:index')->setName('index');
