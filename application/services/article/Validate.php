<?php
/**
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-06-07
 */

namespace Service\Article;

use Service\Article\Entity as Article;
use Service\Article\Exception\CNameExistException;
use Core\Exception\RequestParameterException;

class Validate {

    public $Entity;

    public function __construct(Article $Entity) {
        $this->Entity = $Entity;
    }

    public function create() {
        $this->_fieldTitle();
        $this->_fieldCid();
        $this->_fieldPublishDate();
    }

    public function save() {
        $this->create();
    }

    protected function _fieldTitle() {
        if ( ! $this->Entity->title ) {
            throw new RequestParameterException('文章标题必须填写');
        }
    }

    protected function _fieldCid() {
        if ( ! $this->Entity->cid ) {
            throw new RequestParameterException('文章分类必须选择');
        }
    }

    protected function _fieldPublishDate() {
        if ( "1970-01-01" === $this->Entity->publishdate ) {
            throw new RequestParameterException('文章发布时间必须选择');
        }
    }
}