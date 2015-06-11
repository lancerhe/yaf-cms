<?php
/**
 * Index Controller
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-06-09
 */
class Controller_Index extends \Core\Controller\Index {

    /**
     * @url http://yourdomain/
     */
    public function IndexAction() {
        $Service = new \Service\Article\QueryList();
        $Service->setCName('house', true);
        $Service->setOrderByVisitor();
        $category_house = $Service->fetchAll();

        $this->getView()->assign('category_house',  $category_house);
    }
}