<?php
/**
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-06-06
 */

namespace Service\Core;

class Entity {

    /**
     * Entity row
     * @var array
     */
    protected $_properties = [];

    protected $_changed = [];

    /**
     * 初始化，将数据转化为对象内的一个元素数组信息，类外通过魔术方法调用
     */
    public function __construct($row = []) {
        $this->_properties = array_merge($this->_properties, $row);
    }


    /**
     * 魔术方法直接获取实体内的数据字段值
     * @param  string  $property   字段名
     * @return mixed
     */
    public function __get($property) {
        if ( ! array_key_exists($property, $this->_properties) ) {
            trigger_error( get_class($this) . " has no attrbute: {$property}", E_USER_ERROR);
        }
        return $this->_properties[$property];
    }


    /**
     * 魔术方法直接获取实体内的数据字段值
     * @param  string  $property   字段名
     * @param  string  $value      字段值
     * @return mixed
     */
    public function __set($property, $value) {
        if ( method_exists($this, 'set' . $property) ) {
            call_user_func_array( array($this, 'set' . $property), array($value) );
        } else {
            $this->_properties[$property] = $value;
        }
        $this->_changed[$property]  = $this->_properties[$property];
    }

    public function setProperty($property, $value) {
        $this->_properties[$property] = $value;
        $this->_changed[$property]    = $value;
    }

    public function getProperties() {
        return $this->_properties;
    }

    public function getChanged() {
        return $this->_changed;
    }

    public function hasChanged() {
        return empty( $this->_changed ) ? false : true;
    }

    /**
     * 是否已删除
     * @return boolean
     */
    public function isTrash() {
        return ($this->_properties['deleted']) ? true : false;
    }
}