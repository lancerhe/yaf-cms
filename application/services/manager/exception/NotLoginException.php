<?php
/**
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-11-17
 */

namespace Service\Manager\Exception;

class NotLoginException extends \Core\Exception {

    public $code    = 2004;
    
    public $message = '请先登录';
}