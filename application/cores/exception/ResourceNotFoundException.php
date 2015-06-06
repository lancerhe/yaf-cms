<?php
/**
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-11-02
 */

namespace Core\Exception;

class ResourceNotFoundException extends \Core\Exception {

    public $code    = 930;
    
    public $message = '该资源不存在';
}