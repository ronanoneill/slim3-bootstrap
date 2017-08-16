<?php
/**
 * Index Model
 *
 * @category  Model
 * @package   Slim3 Bootstrap
 * @author    Rónán O'Neill <youcanmailronan@gmail.com>
 * @license   Proprietary
 * @link      N/A
 */

namespace Bootstrap\Model;

class Index extends Model
{
    /**
     * Index Model Constructor
     */
    public function __construct() {}

    /**
     * Define the required view data for the Index controller
     *
     * @return array All data required to render the view
     */
    public function pageRenderData() {
        return ['key' => 'value'];
    }
}
