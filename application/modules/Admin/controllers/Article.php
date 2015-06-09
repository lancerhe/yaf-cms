<?php
/**
 * Admin CP 文章控制器
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-06-07
 */

class Controller_Article extends \Core\Controller\Admin {

    public function IndexAction() {
        $title = trim($this->getRequest()->getQuery('title'));
        $cid   = intval($this->getRequest()->getQuery('cid'));
        $MergeCate = new \Service\ArticleCate\Merge();
        $QueryList = new \Service\Article\QueryList();
        $QueryList->setTitle( $title );
        $QueryList->setCid($cid);
        $QueryList->setLimit( $this->getPageStart(), $this->getPageLimit() );
        $QueryList->setOrderForManager();
        $assoc  = $QueryList->fetchAll();
        $assoc  = $MergeCate->muti($assoc);

        $Page = new \Util_Page();
        $Page->setCurrentPage($this->getCurrentPage());
        $Page->setPageSize($this->getPageLimit());
        $Page->setTotalNum($QueryList->fetchCount());

        $cate_options = \Util_Form::options( (new \Service\ArticleCate\Tree())->queryTreeOptionsList(), $cid, '请选择分类');
        $this->getView()->assign('rows', $assoc);
        $this->getView()->assign('pagination', $Page->output());
        $this->getView()->assign('cate_options', $cate_options);
        $this->getView()->display('article/index.html');
    }

    public function CateAction() {
        $rows  = (new Service\ArticleCate\Tree())->queryAll();
        $this->getView()->assign('rows', $rows);
        $this->getView()->display('article/cate.html');
    }
}
