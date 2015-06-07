<?php
/**
 * Article Cate Model
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-06-06
 */
Class Model_ArticleCate extends \Core\Model\Medoo {

    protected $_pk = 'cid';

    protected $_table = 'article_cate';

    protected $_cname_to_assoc = [];

    protected $_cid_to_assoc = [];

    protected $_fid_assoc = [];

    public function __construct() {
        $rows = $this->medoo()->select($this->_table, "*", ["deleted" => 0]);

        foreach ($rows AS $row) {
            $this->_cname_to_assoc[$row['cname']] = [
                'cid'  => $row['cid'],
                'name' => $row['name']
            ];
            $this->_cid_to_assoc[$row['cid']] = [
                'cname' => $row['cname'],
                'name'  => $row['name']
            ];
            $this->_fid_assoc[$row['fid']][] = [
                'cid'   => $row['cid'],
                'cname' => $row['cname'],
                'name'  => $row['name']
            ];
        }
    }

    public function fetchListRecursion($tree=[], $depth=-1, $return=[]) {
        if ( empty($tree) ) 
            $tree = $this->fetchTreeRecursion();

        $depth ++;
        foreach ($tree as $row) {
            $cate = [
                'cid'   => $row['cid'],
                'cname' => $row['cname'],
                'name'  => $row['name'],
                'depth' => $depth,
            ];
            $return[] = $cate;
            if ( isset( $row['children'] ) ) {
                $return = $this->fetchListRecursion($row['children'], $depth, $return);
            }
        }
        return $return;
    }

    public function fetchTreeRecursion($fid_assoc=array(), $fid=0) {
        if ( empty($fid_assoc) )
            $fid_assoc = $this->_fid_assoc;

        $return = array();
        if ( ! is_array($fid_assoc[$fid]) )
            return false;

        foreach ($fid_assoc[$fid] AS $row) {
            $cid = $row['cid'];
            $return[$cid] = $row;
            
            if ( isset( $fid_assoc[$cid] ) AND is_array( $fid_assoc[$cid] ) ) {
                $return[$cid]['children'] = $this->fetchTreeRecursion($fid_assoc, $cid);
                unset($fid_assoc[$cid]);
            }
        }
        return $return;
    }
}