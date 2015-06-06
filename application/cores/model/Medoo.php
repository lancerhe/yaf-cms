<?php
/**
 * Medoo Model
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-09-15
 */
namespace Core\Model;

use Core\Exception\DatabaseWriteException;

class Medoo {

    protected $_pk = 'id';

    protected $_table = "";

    protected static $_medoo = null;

    public function medoo() {
        if ( ! is_null( self::$_medoo ) ) {
            return self::$_medoo;
        }

        $config = new \Yaf\Config\Ini( APPLICATION_CONFIG_PATH . '/mysql.ini', \Yaf\ENVIRON);

        self::$_medoo = new \medoo([
            'database_type' => $config->database_type,
            'database_name' => $config->database_name,
            'server'        => $config->server,
            'username'      => $config->username,
            'password'      => $config->password,
            'port'          => $config->port,
            'charset'       => $config->charset,
        ]);
        return self::$_medoo;
    }

    public function fetchRowByPk($pk) {
        $rows = $this->medoo()->select($this->_table, '*', [$this->_pk => $pk]);
        return isset($rows[0]) ? $rows[0] : array();
    }

    public function fetchRowsByCondition($condition) {
        return $this->medoo()->select($this->_table, '*', $condition);
    }

    public function fetchCountByCondition($condition) {
        return $this->medoo()->count($this->_table, $condition);
    }

    public function updateRowByPk($pk, $row) {
        if ( ! $affect = $this->medoo()->update($this->_table, $row, [$this->_pk => $pk]) ) {
            throw new DatabaseWriteException();
        }
        return $affect;
    }

    public function insertRow($row) {
        if ( $last_id = $this->medoo()->insert($this->_table, $row) ) 
            return $last_id;

        if ( ! is_null( $this->medoo()->error()[1] ) )
            throw new DatabaseWriteException();
    }
}