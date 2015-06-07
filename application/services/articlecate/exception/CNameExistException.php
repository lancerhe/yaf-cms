<?php
/**
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-06-07
 */

namespace Service\ArticleCate\Exception;

class CNameExistException extends \Core\Exception {

    public $code    = 1403;
    
    public $message = '该分类唯一标识已经存在';
}