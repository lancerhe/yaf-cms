<?php
/**
 * Admin CP 单页控制器
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-06-06
 */

class Controller_Page extends \Core\Controller\Admin {


    public function IndexAction() {
        $QueryList = new \Service\Page\QueryList();
        $QueryList->setLimit( $this->getPageStart(), $this->getPageLimit() );
        $QueryList->setOrderForManager();
        $assoc  = $QueryList->fetchAll();
        $render = [];
        foreach ($assoc as $row) {
            $Entity     = new \Service\Page\Entity($row);
            $row['url'] = $Entity->getUrl();
            $render[] = $row;
        }

        $Page = new \Util_Page();
        $Page->setCurrentPage($this->getCurrentPage());
        $Page->setPageSize($this->getPageLimit());
        $Page->setTotalNum($QueryList->fetchCount());

        $this->getView()->assign('rows', $render);
        $this->getView()->assign('pagination', $Page->output());
        $this->getView()->display('page/index.html');
    }
}
