<?php
/**
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-11-17
 */

namespace Service\Manager\Exception;

class NotFoundException extends \Core\Exception {

    public $code    = 2001;
    
    public $message = '该管理员帐户不存在';
}