<?php
/**
 * Admin CP Ajax UEditor 上传控制器
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-06-06
 */

class Controller_UEditor extends \Core\Controller\Ajax {

    public function UploadAction() {
        $config = array(
            "savePath"   => UPLOAD_PATH ,              //存储文件夹
            "maxSize"    => 1000 ,                   //允许的文件最大尺寸，单位KB
            "allowFiles" => array( ".gif" , ".png" , ".jpg" , ".jpeg" , ".bmp" )  //允许的文件格式
        );

        $up = new Util_UEditorUploader( "upfile" , $config );
        $callback = $this->getRequest()->getQuery('callback');

        $info = $up->getFileInfo();

        if ( $callback ) {
            echo '<script>'.$callback.'('.json_encode($info).')</script>';
        } else {
            echo json_encode($info);
        }
    }
}