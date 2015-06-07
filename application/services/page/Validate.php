<?php
/**
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-06-07
 */

namespace Service\Page;

use Service\Page\Entity as Page;
use Service\Page\Exception\CNameExistException;
use Core\Exception\RequestParameterException;

class Validate {

    public $Entity;

    public function __construct(Page $Entity) {
        $this->Entity = $Entity;
    }

    public function save() {
        $this->_fieldTitle();
        $this->_fieldCName();
        $this->_hasCNameExist();
    }

    protected function _hasCNameExist() {
        $condition = ["AND" => [
            "deleted" => 0,
            "cname"   => $this->Entity->cname
        ] ];
        if ( $this->Entity->id ) {
            $condition["AND"]["id[!]"] = $this->Entity->id;
        }
        
        $rows  = (new \Model_Page())->fetchRowsByCondition($condition);

        if ( isset($rows[0]) ) {
            throw new CNameExistException("该页面唯一标识「{$this->Entity->cname}」已经存在，请更换。");
        }
    }

    protected function _fieldTitle() {
        if ( ! $this->Entity->title ) {
            throw new RequestParameterException('页面名称必须填写');
        }
    }

    protected function _fieldCName() {
        if ( ! $this->Entity->cname ) {
            throw new RequestParameterException('页面唯一标识必须填写');
        }
    }
}