<?php
/**
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-11-22
 */

namespace Service\Setting;

class Entity extends \Core\Entity {

    protected $_properties = [
        'site_name'      => '',
        'site_keywords'  => '',
        'site_descrip'   => '',
        'site_copyright' => '',
        'site_icp'       => '',
        'site_phone'     => '',
        'site_address'   => '',
        'site_qq'        => '',
    ];

    public function save() {
        $model = new \Model_Setting();
        foreach ($this->_changed as $key => $value) {
            $model->update($key, $value);
        }
    }
}