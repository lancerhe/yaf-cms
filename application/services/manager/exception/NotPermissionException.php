<?php
/**
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-11-17
 */

namespace Service\Manager\Exception;

class NotPermissionException extends \Core\Exception {

    public $code    = 2006;
    
    public $message = '您没有权限访问该页面';
}