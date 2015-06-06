<?php
/**
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-11-17
 */

namespace Service\Manager\Exception;

class PasswordNotMatchException extends \Core\Exception {

    public $code    = 2003;
    
    public $message = '帐户密码不匹配';
}