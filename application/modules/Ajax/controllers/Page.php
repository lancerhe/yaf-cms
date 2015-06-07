<?php
/**
 * Admin CP Ajax 单页控制器
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-06-06
 */

class Controller_Page extends \Core\Controller\Ajax {

    /**
     * 删除
     */
    public function TrashAction() {
        $id = intval( $this->getRequest()->getPost('id') );
        $Query = new \Service\Page\Query($id);
        $Query->filterTrash();
        $Entity = $Query->getEntity();
        $Entity->trash();

        $this->getView()->display('删除成功');
    }

    /**
     * 创建渲染模板
     */
    public function AddPopupAction() {
        $this->getView()->display('渲染成功', $this->getView()->render('page/add.html') );
    }

    /**
     * 编辑渲染模板
     */
    public function EditPopupAction() {
        $id = intval( $this->getRequest()->getPost('id') );
        $Query = new \Service\Page\Query($id);
        $Query->filterTrash();
        
        $this->getView()->assign('row', $Query->getAssoc());
        $this->getView()->assign('content', $Query->getEntity()->content);
        $this->getView()->display('渲染成功', $this->getView()->render('page/edit.html') );
    }

    /**
     * 创建
     */
    public function CreateAction() {
        $Entity = new \Service\Page\Entity();
        $Entity->title   = $this->getRequest()->getPost('title');
        $Entity->cname   = $this->getRequest()->getPost('cname');
        $Entity->keyword = $this->getRequest()->getPost('keyword');
        $Entity->desc    = $this->getRequest()->getPost('desc');
        $Entity->content = $this->getRequest()->getPost('content');
        $Entity->create();
        $this->getView()->display('创建成功');
    }

    /**
     * 保存
     */
    public function SaveAction() {
        $id = intval( $this->getRequest()->getPost('id') );
        $Query = new \Service\Page\Query($id);
        $Query->filterTrash();

        $Entity = $Query->getEntity();
        $Entity->title   = $this->getRequest()->getPost('title');
        $Entity->cname   = $this->getRequest()->getPost('cname');
        $Entity->keyword = $this->getRequest()->getPost('keyword');
        $Entity->desc    = $this->getRequest()->getPost('desc');
        $Entity->content = $this->getRequest()->getPost('content');
        $Entity->save();
        $this->getView()->display('保存成功');
    }
}
