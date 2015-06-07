<?php
/**
 * Admin CP 文章控制器
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-06-07
 */

class Controller_Article extends \Core\Controller\Admin {

    public function IndexAction() {
        $QueryList = new \Service\Article\QueryList();
        $QueryList->setLimit( $this->getPageStart(), $this->getPageLimit() );
        $QueryList->setOrderForManager();
        $assoc  = $QueryList->fetchAll();
        $render = [];
        foreach ($assoc as $row) {
            $Entity     = new \Service\Article\Entity($row);
            $row['url'] = $Entity->getUrl();
            $render[] = $row;
        }

        $Page = new \Util_Page();
        $Page->setCurrentPage($this->getCurrentPage());
        $Page->setPageSize($this->getPageLimit());
        $Page->setTotalNum($QueryList->fetchCount());

        $this->getView()->assign('rows', $render);
        $this->getView()->assign('pagination', $Page->output());
        $this->getView()->display('article/index.html');
    }

    public function CateAction() {
        $rows  = (new Service\Article\Cate)->queryTreeRecords();
        $this->getView()->assign('rows', $rows);
        $this->getView()->display('article/cate.html');
    }
}
