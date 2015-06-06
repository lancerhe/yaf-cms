<?php
/**
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-11-17
 */

namespace Service\Manager\Exception;

class HasTrashException extends \Core\Exception {

    public $code    = 2002;
    
    public $message = '该管理员帐户已被禁用';
}