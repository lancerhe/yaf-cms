<?php
/**
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-06-06
 */

namespace Service\Core;

class Query {

    protected $_assoc;

    protected $_entity;

    public function getAssoc() {
        return $this->_assoc;
    }

    public function getEntity() {
        return $this->_entity;
    }
}