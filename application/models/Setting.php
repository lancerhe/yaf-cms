<?php
/**
 * Setting Model
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-06-06
 */
Class Model_Setting extends \Core\Model\Medoo {

    protected $_table = 'setting';

    public function fetchList() {
        $rows = $this->medoo()->select($this->_table, '*');
        $list = \Util_Array::column($rows, 'value', 'key');
        return $list;
    }

    public function update($key, $value) {
        return $this->medoo()->update($this->_table, ['value' => $value], ['key' => $key]);
    }
}