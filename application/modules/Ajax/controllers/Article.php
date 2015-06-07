<?php
/**
 * Admin CP Ajax 文章控制器
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-06-07
 */

class Controller_Article extends \Core\Controller\Ajax {

    /**
     * 删除
     */
    public function TrashAction() {
        $id = intval( $this->getRequest()->getPost('id') );
        $Query = new \Service\Article\Query($id);
        $Query->filterTrash();
        $Query->getEntity()->trash();

        $this->getView()->display('删除成功');
    }

    /**
     * 创建渲染模板
     */
    public function AddPopupAction() {
        $cate_options = (new Service\ArticleCate\Tree)->queryTreeOptionsList();
        $this->getView()->assign('cate_options', \Util_Form::options($cate_options, null, '请选择分类'));
        $this->getView()->display('渲染成功', $this->getView()->render('article/add.html') );
    }

    /**
     * 编辑渲染模板
     */
    public function EditPopupAction() {
        $id = intval( $this->getRequest()->getPost('id') );
        $Query = new \Service\Article\Query($id);
        $Query->filterTrash();
        $assoc = $Query->getAssoc();

        $cate_options = (new Service\ArticleCate\Tree)->queryTreeOptionsList();
        $this->getView()->assign('cate_options', \Util_Form::options($cate_options, intval($assoc['cid'])));
        $this->getView()->assign('row', $assoc);
        $this->getView()->display('渲染成功', $this->getView()->render('article/edit.html') );
    }

    /**
     * 创建
     */
    public function CreateAction() {
        $Entity              = new \Service\Article\Entity();
        $Entity->title       = $this->getRequest()->getPost('title');
        $Entity->cid         = $this->getRequest()->getPost('cid');
        $Entity->keyword     = $this->getRequest()->getPost('keyword');
        $Entity->desc        = $this->getRequest()->getPost('desc');
        $Entity->publishdate = $this->getRequest()->getPost('publishdate');
        $Entity->content     = $this->getRequest()->getPost('content');
        $Entity->create();
        $this->getView()->display('创建成功');
    }

    /**
     * 保存
     */
    public function SaveAction() {
        $id = intval( $this->getRequest()->getPost('id') );
        $Query = new \Service\Article\Query($id);
        $Query->filterTrash();

        $Entity              = $Query->getEntity();
        $Entity->title       = $this->getRequest()->getPost('title');
        $Entity->cid         = $this->getRequest()->getPost('cid');
        $Entity->keyword     = $this->getRequest()->getPost('keyword');
        $Entity->desc        = $this->getRequest()->getPost('desc');
        $Entity->publishdate = $this->getRequest()->getPost('publishdate');
        $Entity->content     = $this->getRequest()->getPost('content');
        $Entity->save();
        $this->getView()->display('保存成功');
    }
}