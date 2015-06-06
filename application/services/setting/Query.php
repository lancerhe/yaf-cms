<?php
/**
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-06-06
 */

namespace Service\Setting;

use Service\Setting\Entity;
use Service\Core\Query as Core_Query;

class Query extends Core_Query {

    public function __construct() {
        $model = new \Model_Setting();
        $row   = $model->fetchList();
        $this->_assoc  = $row;
        $this->_entity = new Entity($row);
    }
}