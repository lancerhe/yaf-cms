<?php
/**
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-06-07
 */

namespace Service\ArticleCate;

use Service\ArticleCate\Entity as ArticleCate;
use Service\ArticleCate\Exception\CNameExistException;
use Core\Exception\RequestParameterException;

class Validate {

    public $Entity;

    public function __construct(ArticleCate $Entity) {
        $this->Entity = $Entity;
    }

    public function create() {
        $this->_fieldName();
        $this->_fieldCName();
        $this->_hasCNameExist();
    }

    public function save() {
        $this->create();
    }

    protected function _hasCNameExist() {
        $condition = ["AND" => [
            "deleted" => 0,
            "cname"   => $this->Entity->cname
        ] ];
        if ( $this->Entity->cid ) {
            $condition["AND"]["cid[!]"] = $this->Entity->cid;
        }
        
        $rows  = (new \Model_ArticleCate())->fetchRowsByCondition($condition);

        if ( isset($rows[0]) ) {
            throw new CNameExistException("该分类唯一标识「{$this->Entity->cname}」已经存在，请更换。");
        }
    }

    protected function _fieldName() {
        if ( ! $this->Entity->name ) {
            throw new RequestParameterException('分类名称必须填写');
        }
    }

    protected function _fieldCName() {
        if ( ! $this->Entity->cname ) {
            throw new RequestParameterException('分类唯一标识必须填写');
        }
    }
}