<?php

/*
 * @Developed by : Ahmed Abd Elhaliem .
 * @Developer Site: http//www.elmosamem.com 
 */

class model extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function NewInsert($table, $coulmns, $where = "") {
        $result = $this->insert($table, $coulmns, $where);
        return $result;
    }

    public function NewUpdate($table, $coulmns, $where = "") {
        $result = $this->update($table, $coulmns, $where);
        return $result ;
    }

    public function New_Multi_Insert($table, $coulmns, $values, $cond = "") {
        $result = $this->multi_insert($table, $coulmns, $values, $cond);
        return ($result) ? $this->db->insert_id : false;
    }

    public function Get($table, $columns = '*', $cond = "",$order_by='id', $arrangement='DESC',$start=null,$per_page=null) {
        $result = $this->select($columns, $table, $cond,$order_by, $arrangement,$start,$per_page);
        return $result;
    }

    public function Wipe($table, $ids) {
        $result = $this->delete($table, $ids);
        return $result;
    }
    
    public function Get_Multilevel($table,$select,$cond = "") {
        $id_list = $this->arrange_records($table,$cond);
        if($id_list > 0)
        {
            $ids = implode(',', $id_list);
            $where = " WHERE id IN ({$ids}) ORDER BY FIND_IN_SET(id,'{$ids}') ";
            $result = $this->select($select, $table, $where);
            return $result;
        }else
        {
            return $id_list;
        }
    }
    
    public function Check_items_Under_category($table,$category_id) {
        $where = ' WHERE cat_id = '.$category_id.' LIMIT 1 ';
        $result = $this->db_count_records($table,$where);
        return $result;
    }
    
    public function Is_There_Sons($table,$parent_id) {
        $where = ' WHERE parent_id = '.$parent_id.' LIMIT 1 ';
        $result = $this->db_count_records($table,$where);
        return $result;
    }
    public function Count_Rows($table,$cond="") {
        $result = $this->db_count_records($table,$cond);
        return $result;
    }

    /**
     * cut a words ..
     * @param string $words
     * @param int $statr_cut
     * @param int $length
     * @param string $strip_tags yes or no
     */
    public function Cut_Words($words, $start_cut, $length) {
        $output = '';
        $words = stripslashes(strip_tags($this->Delete_Lines($words)));
        $num_text = mb_strlen($words, 'utf-8');
        if ($num_text > $length) {
            $output .= mb_substr($words, $start_cut, $length, 'utf-8');
            $output .= ' ... ';
        } else {
            $output = $words;
        }
        return $output;
    }

    /**
     * publish multi records
     * @param string $table database table name
     * @param string $ids the ids for delete seprated by comas(,)
     * @return int count of efficted rows
     */
    function publish($table, $ids) {
        is_array($ids) ? implode(',', $ids) : null;
        $result = $this->update($table, array('status' => 1), 'WHERE id IN (' . $ids . ')');
        return ($result) ? true : false;
    }

    /**
     * unpublish multi records
     * @param string $table database table name
     * @param string $ids the ids for delete seprated by comas(,)
     * @return int count of efficted rows
     */
    function unpublish($table, $ids) {
        is_array($ids) ? implode(',', $ids) : null;
        $result = $this->update($table, array('status' => 0), 'WHERE id IN (' . $ids . ')');
        return ($result) ? true : false;
    }
    function readable($table, $ids) {
        is_array($ids) ? implode(',', $ids) : null;
        $result = $this->update($table, array('readable' => 1), 'WHERE id IN (' . $ids . ')');
        return ($result) ? true : false;
    }
    
    public function Update_Default($table,$id)
    {
        $prepard = array('is_default'=>'0');
        $cond = " WHERE is_default = '1' ";
        if($this->update($table, $prepard, $cond))
        {
            $prepard = array('is_default'=>'1','status'=>'1');
            $cond = " WHERE id = '".$id."' ";
            return ($this->update($table, $prepard, $cond)) ? true : false ;
        }
    }
    
    public function Authenticate($email, $password) {
        $where = " WHERE email = '" . $email . "' AND password = '" . $password . "' AND admin= '2' LIMIT 1 ";
        $result = $this->select('id,username,alias,avatar','users',$where);
        if(is_array($result))
        {
            $id = $result[0]['id'];
            $coulmns = array('last_login' => time());
            $where = " WHERE id = '".$id."' ";
            $this->NewUpdate('users', $coulmns, $where);
        }
        return is_array($result) ? $result : FALSE;
    }
    public function new_line($text) {
        $rep = array('\r\n', '\r', '\n', '\\');
        $text = str_replace($rep, '<br/>', $text);
        return $text;
    }
    public function Delete_Lines($text) {
        $rep = array('\r\n', '\r', '\n', '\\');
        $text = str_replace($rep, ' ', $text);
        return $text;
    }

}
