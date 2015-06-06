<?php
/**
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-06-06
 */

namespace Service\Page;

use Service\Core\Entity as Core_Entity;

class Entity extends Core_Entity {

    protected $_properties = [
        'id'         => 0,
        'title'      => '',
        'cname'      => '',
        'keyword'    => '',
        'desc'       => '',
        'content'    => '',
        'createtime' => 0,
        'updatetime' => 0,
        'deleted'    => 0,
    ];

    public function getUrl() {
        return PUBLIC_URL . "/page/" . $this->_properties['cname'];
    }

    public function trash() {
        $this->setProperty('deleted',    1);
        $this->setProperty('updatetime', time());
        $model = new \Model_Page();
        $model->updateRowByPk($this->_properties['id'], $this->_changed);
    }

    // public function publish() {
    //     $this->setProperty('createtime',  time());
    //     $this->setProperty('publishtime', time());
    //     $this->setProperty('publishdate', date('Y-m-d', time()));
    //     $this->setProperty('status',      2);
    //     $this->setProperty('reply',       '您的报修请求已收到，我们将尽快处理');
    //     $model = new \Model_Call();
    //     $this->setProperty('id', $model->insertRow($this->_properties) );
    // }
}