<?php
/**
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-06-07
 */

namespace Service\Article;

use Service\Core\Entity as Core_Entity;
// use Service\Page\Validate;

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

    public function setTitle($title) {
        $this->_properties['title'] = trim($title);
    }

    public function setCname($cname) {
        $cname = trim($cname);
        $cname = str_replace(" ", "", $cname);
        $this->_properties['cname'] = $cname;
    }

    public function setKeyword($keyword) {
        $keyword = trim($keyword);
        $keyword = str_replace("，", ",", $keyword);
        $this->_properties['keyword'] = $keyword;
    }

    public function setDesc($desc) {
        $this->_properties['desc'] = trim($desc);
    }

    public function setContent($content) {
        $this->_properties['content'] = $content;
    }

    public function getContent($content) {
        return htmlspecialchars_decode($this->_properties['content']);
    }

    public function getUrl() {
        return PUBLIC_URL . "/page/" . $this->_properties['cname'];
    }

    public function trash() {
        $this->setProperty('deleted',    1);
        $this->setProperty('updatetime', time());
        $model = new \Model_Page();
        $model->updateRowByPk($this->_properties['id'], $this->_changed);
    }

    public function save() {
        (new Validate($this))->save();
        $this->setProperty('updatetime',  time());
        $model = new \Model_Page();
        $model->updateRowByPk($this->_properties['id'], $this->_changed);
    }

    public function create() {
        (new Validate($this))->create();
        $this->setProperty('createtime',  time());
        $this->setProperty('updatetime',  time());
        $model = new \Model_Page();
        $this->_properties['id'] = $model->insertRow($this->_properties);
    }
}