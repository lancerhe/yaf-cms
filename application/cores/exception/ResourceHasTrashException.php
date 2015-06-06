<?php
/**
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-11-02
 */

namespace Core\Exception;

class ResourceHasTrashException extends \Core\Exception {

    public $code    = 931;
    
    public $message = '该资源已经被删除';
}