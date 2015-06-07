<?php
/**
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-06-07
 */

namespace Service\ArticleCate;

use Service\Core\Entity as Core_Entity;
use Service\ArticleCate\Tree;
use Service\ArticleCate\Validate;

class Entity extends Core_Entity {

    protected $_properties = [
        'cid'        => 0,
        'name'       => '',
        'cname'      => '',
        'fid'        => 0,
        'createtime' => 0,
        'updatetime' => 0,
        'deleted'    => 0,
    ];

    public function setName($name) {
        $this->setProperty('name', trim($name));
    }

    public function setCname($cname) {
        $cname = trim($cname);
        $cname = str_replace(" ", "", $cname);
        $this->setProperty('cname', $cname);
    }

    public function setFid($fid) {
        $this->setProperty('fid', intval($fid));
    }

    public function create() {
        (new Validate($this))->create();
        $this->setProperty('createtime',  time());
        $this->setProperty('updatetime',  time());
        $model = new \Model_ArticleCate();
        $this->setProperty('cid', $model->insertRow($this->_properties) );
    }

    public function save() {
        (new Validate($this))->save();
        $this->setProperty('updatetime',  time());
        $model = new \Model_ArticleCate();
        $model->updateRowsByPk($this->_properties['cid'], $this->_changed);
    }

    public function trash() {
        $trash_ids = (new Tree)->queryChildrenIdsAndSelfId($this->_properties['cid']);
        $model = new \Model_ArticleCate();
        $model->updateRowsByPk($trash_ids, ["deleted" => 1, "updatetime" => time()]);
    }
}