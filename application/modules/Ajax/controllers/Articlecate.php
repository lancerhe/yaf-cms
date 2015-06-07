<?php
/**
 * Admin CP Ajax 文章分类控制器
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-06-07
 */

class Controller_ArticleCate extends \Core\Controller\Ajax {

    /**
     * 删除
     */
    public function TrashAction() {
        $id = intval( $this->getRequest()->getPost('id') );
        $Query = new \Service\ArticleCate\Query($id);
        $Query->filterTrash();
        $Query->getEntity()->trash();

        $this->getView()->display('删除成功');
    }

    /**
     * 创建渲染模板
     */
    public function AddPopupAction() {
        $cate_options = (new Service\ArticleCate\Tree)->queryTreeOptionsList();
        $this->getView()->assign('cate_options', \Util_Form::options($cate_options, null, '顶级分类'));
        $this->getView()->display('渲染成功', $this->getView()->render('articlecate/add.html') );
    }

    /**
     * 创建渲染模板
     */
    public function EditPopupAction() {
        $id = intval( $this->getRequest()->getPost('id') );
        $Query = new \Service\ArticleCate\Query($id);
        $Query->filterTrash();
        $row = $Query->getAssoc();

        $cate_options = (new Service\ArticleCate\Tree)->queryTreeOptionsListWithoutId($id);
        $this->getView()->assign('cate_options', \Util_Form::options($cate_options, intval($row['fid']), '顶级分类'));
        $this->getView()->assign('row', $row);
        $this->getView()->display('渲染成功', $this->getView()->render('articlecate/edit.html') );
    }

    /**
     * 保存
     */
    public function CreateAction() {
        $Entity        = new \Service\ArticleCate\Entity();
        $Entity->name  = $this->getRequest()->getPost('name');
        $Entity->cname = $this->getRequest()->getPost('cname');
        $Entity->fid   = $this->getRequest()->getPost('fid');
        $Entity->create();
        $this->getView()->display('创建成功');
    }

    /**
     * 保存
     */
    public function SaveAction() {
        $id = intval( $this->getRequest()->getPost('id') );
        $Query = new \Service\ArticleCate\Query($id);
        $Query->filterTrash();

        $Entity        = $Query->getEntity();
        $Entity->name  = $this->getRequest()->getPost('name');
        $Entity->cname = $this->getRequest()->getPost('cname');
        $Entity->fid   = $this->getRequest()->getPost('fid');
        $Entity->save();
        $this->getView()->display('保存成功');
    }
}