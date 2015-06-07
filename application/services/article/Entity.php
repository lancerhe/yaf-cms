<?php
/**
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-06-07
 */

namespace Service\Article;

use Service\Core\Entity as Core_Entity;
// use Service\Page\Validate;

class Entity extends Core_Entity {

    protected $_properties = [
        'id'          => 0,
        'cid'         => 0,
        'title'       => '',
        'intro'       => '',
        'keyword'     => '',
        'desc'        => '',
        'content'     => '',
        'thumbnails'  => '',
        'hasimage'    => 0,
        'views'       => 0,
        'top'         => 0,
        'createtime'  => 0,
        'updatetime'  => 0,
        'publishdate' => '',
        'deleted'     => 0,
    ];

    public function setTitle($title) {
        $this->setProperty('title', trim($title));
    }

    public function setCid($cid) {
        $this->setProperty('cid', intval($cid));
    }

    public function setKeyword($keyword) {
        $keyword = trim($keyword);
        $keyword = str_replace("，", ",", $keyword);
        $this->setProperty('keyword', $keyword);
    }

    public function setDesc($desc) {
        $this->setProperty('desc', trim($desc));
    }

    public function setPublishDate($date) {
        $this->setProperty('publishdate', date('Y-m-d', strtotime($date)) );
    }

    public function setContent($content) {
        $nohtml_content = strip_tags($content);
        $nohtml_content = preg_replace("/\s/","", $nohtml_content);
        $this->setProperty('content', $content);
        if ( empty($this->_properties['intro']) ) {
            $this->setProperty('intro', \Util_String::cutString($nohtml_content, 200) );
        }

        if ( empty($this->_properties['desc']) ) {
            $this->setProperty('desc', \Util_String::cutString($nohtml_content, 200, '') );
        }
        /* set has attachment */
        preg_match_all("/<img([^>]*)src=\"".str_replace("/", "\/", PUBLIC_URL)."\/upload\/([^\"]*)\"([^>]*)\>/", $content, $matchs);
        if ( is_array($matchs[2]) AND count($matchs[2]) > 0) {
            $this->setProperty('hasimage', 1);
            $this->setProperty('thumbnails', json_encode($matchs[2]));
        } else {
            $this->setProperty('hasimage', 0);
            $this->setProperty('thumbnails', json_encode([]));
        }
    }

    public function getContent($content) {
        return htmlspecialchars_decode($this->_properties['content']);
    }

    public function trash() {
        $this->setProperty('deleted',    1);
        $this->setProperty('updatetime', time());
        (new \Model_Article())->updateRowsByPk($this->_properties['id'], $this->_changed);
    }

    public function save() {
        (new Validate($this))->save();
        $this->setProperty('updatetime',  time());
        (new \Model_Article())->updateRowsByPk($this->_properties['id'], $this->_changed);
    }

    public function create() {
        (new Validate($this))->create();
        $this->setProperty('createtime',  time());
        $this->setProperty('updatetime',  time());
        $this->setProperty('id', (new \Model_Article())->insertRow($this->_properties) );
    }
}