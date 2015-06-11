<?php
/**
 * Index Controller
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-06-11
 */
class Controller_Article extends \Core\Controller\Index {

    /**
     * @url http://yourdomain/
     */
    public function ListAction($cname, $page=1) {
        var_dump($cname, $page);
    }

    /**
     * @url http://yourdomain/article-2.html
     */
    public function ShowAction($id) {
        var_dump($id);
    }
}