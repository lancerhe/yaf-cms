<?php
/**
 * Index Controller
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-06-11
 */
class Controller_Page extends \Core\Controller\Index {

    /**
     * @url http://yourdomain/page-aboutus.html
     */
    public function ShowAction($cname) {
        var_dump($cname);
    }
}