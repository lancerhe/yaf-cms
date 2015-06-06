<?php
/**
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-11-22
 */

namespace Service\Setting;

use Service\Setting\Entity;

class Query {

    public function __construct() {
        $model = new \Model_Setting();
        $row   = $model->fetchList();
        $this->_assoc  = $row;
        $this->_entity = new Entity($row);
    }

    public function getAssoc() {
        return $this->_assoc;
    }

    public function getEntity() {
        return $this->_entity;
    }
}