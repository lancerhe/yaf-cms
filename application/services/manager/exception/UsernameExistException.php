<?php
/**
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-12-14
 */

namespace Service\Manager\Exception;

class UsernameExistException extends \Core\Exception {

    public $code    = 2005;
    
    public $message = '用户名已经存在';
}