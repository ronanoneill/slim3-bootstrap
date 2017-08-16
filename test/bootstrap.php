<?php
/**
 * Bootstrap all required resources to run the test suite
 *
 * @category  Test
 * @package   Slim3 Bootstrap
 * @author    Rónán O'Neill <youcanmailronan@gmail.com>
 * @license   Proprietary
 * @link      N/A
 */

// Include Composer's autoload https://getcomposer.org/doc/01-basic-usage.md#autoloading
require __DIR__ . '/../vendor/autoload.php';

// Handle UTF-8 encoding
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');

// Define / Load mocked DB and data here if required
