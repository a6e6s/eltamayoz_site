<?php
/*
 * @package Engazz Project .
 * @Engazz Web Solution .
 * @http://engazz.com 
 * @Developed by : engazz team .
 * @Developer Site: http//engazz.com 
 */

class Controller {

    public $db;
    public $view;

    public function __construct() {
        //error_reporting(0);
        $this->db = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        if ($this->db->connect_errno) {
            die('Failed to Connect to MYSql . ' . $this->db->connect_error);
        } else {
            $this->db->query("SET NAMES 'utf8'");
        }
        $this->view = new View();
    }

    /**
     * @escapes special characters in a string and trim white spaces
     * @param string $string
     * @param string $allowable_tags The HTML allowable tags
     * @return string escapes special characters in a string
     */
    function filtrate($string, $allowable_tags = null) {
        $c_string = $this->db->real_escape_string(trim(strip_tags($string, $allowable_tags)));
        return $c_string;
    }

    /**
     * get records from table
     * @param string $table required
     * @param string $cols optional
     * @param string $cond WHERE condation optional
     * @return array
     */
    function select2($tabls, $cond = " ", $cols = "*") {
        $sql = "SELECT " . $cols . " FROM " . $tabls . " " . $cond;
        if (!$result = $this->db->query($sql)) {
            trigger_error('Query error : ' . $db->error, E_USER_ERROR);
        }
        if (method_exists('mysqli_result', 'fetch_all')) {
            $data = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
        } else {
            for ($data = array(); $tmp = $result->fetch_array(MYSQLI_ASSOC);)
                $data[] = $tmp;
        }
        return $data;
    }

    /**
     * get records from table
     * @param string $select required
     * @param string $table required
     * @param string $orderby optional
     * @param string $arrangement optional
     * @param string $where optional
     * @param int $start optional
     * @param int $per_page optional
     * @return array of all records 
     */
    public function select($select, $table, $where = null, $orderby = null, $arrangement = null, $start = 0, $per_page = null) {
        ($per_page != null) ? $limit = ' LIMIT ' . $start . ',' . $per_page : $limit = null;
        $OrderBy = ($orderby != null ) ? 'ORDER BY ' . $orderby : null;
        $sql = 'SELECT DISTINCT ' . $select . ' FROM ' . $table . ' ' . $where . ' ' . $OrderBy . ' ' . $arrangement . ' ' . $limit;
        if ($result = $this->db->query($sql)) {
            if ($result->num_rows > 0) {
                $rows = array();
                while ($fetch = $result->fetch_assoc()) {
                    $rows[] = $fetch;
                }
                return $rows;
                $result->free();
            } else {
                return $result->num_rows;
            }
        } else {
            return false;
        }
    }

    /**
     * @Select single record condation
     * @param string Table name
     * @param string condation name
     * @param string colomns name
     * @return array
     */
    function select_single($table, $cond = "", $cols = '*') {
        $result = select($table, $cond . ' LIMIT 1', $cols);
        if (!$result) {
            return $result;
        } else {
            return $result[0];
        }
    }

    /**
     * Insert data in the database table
     * @param string $table_name
     * @param array $prepar
     * @param string $cond
     * @return boolen
     */
    function insert($table, $coulmns, $cond = "") {
        foreach ($coulmns as $col => $value) {
            $prepared_cols [] = "`" . $col . "`";
            $prepared_values [] = "'" . $this->filtrate($value) . "'";
        }
        $set_cols = implode(',', $prepared_cols);
        $set_values = implode(',', $prepared_values);
        $query = 'INSERT INTO ' . $table . ' (' . $set_cols . ') VALUES (' . $set_values . ') ' . $cond;
        if ($this->db->query($query)) {
            return true;
        } else {
            return FALSE;
        }
    }

    /**
     * Insert data in the database table
     * @param string $table_name
     * @param array $prepar
     * @param string $cond
     * @return boolen
     */
    function multi_insert($table, $coulmns,$values, $cond = "") {
        (is_array($values)) ? $set_values = implode(',',$values) : null;
        (is_array($coulmns)) ? $coulmns = implode(',',$coulmns) : null;
        echo $query = 'INSERT INTO ' . $table . ' (' . $coulmns . ') VALUES '.$set_values.' ' . $cond;
        if ($this->db->query($query)) {
            return true;
        } else {
            return FALSE;
        }
    }

    /**
     * excute query update
     * @param string $table database table name
     * @param string $prepard
     * @param string $condation optinal
     * @return int count of efficted rows
     */
    function update($table, $prepard, $cond = "") {
        foreach ($prepard as $col => $value) {
            $binding[] = "`" . $col . "`='" . $this->filtrate($value) . "'";
        }
        $statment = implode(',', $binding);
        $query = 'UPDATE ' . $table . ' SET ' . $statment . ' ' . $cond;
        if (!$this->db->query($query)) {
            //trigger_error("Query Failed: (" . $this->db->errno . ") " . $this->db->error, E_USER_ERROR);
        } else {
            //return $this->db->affected_rows;
            return true;
        }
    }

    /**
     * publish multi records
     * @param string $table database table name
     * @param string $ids the ids for delete seprated by comas(,)
     * @return int count of efficted rows
     */
    function publish($table, $ids) {
        is_array($ids) ? implode(',', $ids) : null;
        return update($table, array('status' => 1), 'WHERE id IN (' . $ids . ')');
    }

    /**
     * unpublish multi records
     * @param string $table database table name
     * @param string $ids the ids for delete seprated by comas(,)
     * @return int count of efficted rows
     */
    function unpublish($table, $ids) {
        is_array($ids) ? implode(',', $ids) : null;
        return update($table, array('status' => 0), 'WHERE id IN (' . $ids . ')');
    }

    /**
     * feature multi records
     * @param string $table database table name
     * @param string $ids the ids for delete seprated by comas(,)
     * @return int count of efficted rows
     */
    function feature($table, $ids) {
        is_array($ids) ? implode(',', $ids) : null;
        return update($table, array('feature' => 1), 'WHERE id IN (' . $ids . ')');
    }

    /**
     * unfeature multi records
     * @param string $table database table name
     * @param string $ids the ids for delete seprated by comas(,)
     * @return int count of efficted rows
     */
    function unfeature($table, $ids) {
        is_array($ids) ? implode(',', $ids) : null;
        return update($table, array('feature' => 0), 'WHERE id IN (' . $ids . ')');
    }

    /**
     * delete multi records
     * @param string $table database table name
     * @param array/string $ids the ids for delete seprated by comas(,)
     * @return int count of efficted rows
     */
    function delete($table, $ids) {
        is_array($ids) ? implode(',', $ids) : null;
        $query = 'DELETE from ' . $table . ' WHERE id IN (' . $ids . ')';
        if (!$this->db->query($query)) {
            trigger_error("Query Failed: (" . $db->errno . ") " . $db->error, E_USER_ERROR);
        } else {
            return $this->db->affected_rows;
        }
    }

    /**
     * count total rows
     * @param string $table database table
     * @param string $table_field field selected in database  
     * @param string $cond condation statment
     * @return int count of records
     */
    function db_count_records($table, $table_field, $cond = "") {
        $sql = 'SELECT COUNT(DISTINCT ' . $table_field . ') as id FROM ' . $table . ' ' . $cond;
        if ($result = $this->db->query($sql)) {
            $fetch = $result->fetch_assoc();
            return $fetch['id'];
            $result->free();
        } else {
            return false;
        }
    }

    /**
     * get multi level records
     * @param string $table database table
     * @param string  $condation
     * @return array array of all records ips sorted from pparent to chiled
     */
    public function arrange_records($table, $cond = "", $list_ids = array()) {
        $total = $this->select('id,parent_id', $table, $cond);
        if (is_array($total)) {
            foreach ($total as $parent) {
                if ($parent['parent_id'] == 0) {
                    $list_ids[] = $parent['id'];
                    $this->arrange_child($total, $parent['id'], $list_ids);
                }
            }
            return $list_ids;
        } else {
            return false;
        }
    }

    /**
     * @param array $total
     * @param int $parent_id
     * @param array $list_ids
     */
    public function arrange_child($total, $parent_id, &$list_ids) {
        foreach ($total as $child) {
            if ($child['parent_id'] == $parent_id) {
                $list_ids[] = $child['id'];
                $this->arrange_child($total, $child['id'], $list_ids);
            }
        }
    }

    /**
     * get multi level records
     * @param string $table database table
     * @param int $start_arrange id of parent_id 
     * @return array array of all records ips sorted from pparent to chiled
     */
    public function Family_Tree_ASC($total, $start_arrange = 0, $list_ids = array()) {
        if (is_array($total)) {
            foreach ($total as $parent) {
                if ($parent['parent_id'] == $start_arrange) {
                    $list_ids[] = $parent['id'];
                    $this->Loop_Family_Tree_ASC($total, $parent['id'], $list_ids);
                }
            }
            return $list_ids;
        } else {
            return false;
        }
    }

    /**
     * @param array $total
     * @param int $parent_id
     * @param array $list_ids
     */
    public function Loop_Family_Tree_ASC($total, $parent_id, &$list_ids) {
        foreach ($total as $child) {
            if ($child['parent_id'] == $parent_id) {
                $list_ids[] = $child['id'];
                $this->Loop_Family_Tree_ASC($total, $child['id'], $list_ids);
            }
        }
    }

    /**
     * get multi level records
     * @param string $table database table
     * @param int $start_arrange id of parent_id 
     * @return array array of all records ips sorted from pparent to chiled
     */
    public function Family_Tree_DESC($total, $start_arrange = 0, $list_ids = array()) {
        if (is_array($total)) {
            foreach ($total as $parent) {
                if ($parent['id'] == $start_arrange) {
                    $list_ids[] = $parent['parent_id'];
                    $this->Loop_Family_Tree_DESC($total, $parent['parent_id'], $list_ids);
                }
            }
            return $list_ids;
        } else {
            return false;
        }
    }

    /**
     * @param array $total
     * @param int $parent_id
     * @param array $list_ids
     */
    public function Loop_Family_Tree_DESC($total, $parent_id, &$list_ids) {
        foreach ($total as $child) {
            if ($child['id'] == $parent_id) {
                $list_ids[] = $child['parent_id'];
                $this->Loop_Family_Tree_DESC($total, $child['parent_id'], $list_ids);
            }
        }
    }

    /*     * ************************** Tools functions *********************************** */

    /**
     * validation
     * @param variable $var pathing variable for validation
     * @param string $type the tyb of the var like (text,email,url,number,date)
     * @return boolean is it valide or not.
     */
    function is_valid($type, $var) {
        switch ($type) {
            case 'text' :return (bool) preg_match("/^[a-zA-Z ]*$/i", $var);
                break;
            case 'email':return (bool) (filter_var($var, FILTER_VALIDATE_EMAIL));
                break;
            case 'url' :return (bool) (preg_match('/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i', $var));
                break;
            case 'number' :return (bool) (preg_match("/^[-+]?[0-9]*.?[0-9]+$/", $var));
                break;
            case 'date' :return (strtotime($var) !== false);
                break;
        }
    }

    /*
     * calculate the total pages ..
     */

    public function total_page($total_count, $per_page) {
        return ceil($total_count / $per_page);
    }

    /*
     * calculate the start of page ..
     */

    public function starter($current_page, $per_page) {
        return ($current_page - 1) * $per_page;
    }

    /*
     * pagination ..
     */

    public function create_pagination($total_pages, $current_page, $url) {
        $min = (($current_page - 10) < 1 ) ? 1 : ($current_page - 10);
        $max = (($current_page + 10) > $total_pages ) ? $total_pages : ($current_page + 10);
        for ($x = $min; $x <= $max; $x++) {
            ?>
            <li <?php if ($x == $current_page) echo 'class="active"'; ?>><a href="<?php echo $url . $x; ?>"><?php echo $x; ?></a></li>
            <?php
        }
    }

    /**
     * search ....
     */
    public function Count_Search($table, $column, $search_column, $keywords, $where = null) {
        $keywords = $this->db->real_escape_string($keywords);
        $keywords = preg_split('/[\s]+/', $keywords);
        $total_keywords = count($keywords);
        $where .= " AND ";
        foreach ($keywords as $key => $keyword) {
            $where .= "FROM_BASE64(".$search_column . ") LIKE '%" . $keyword . "%' ";
            if ($key != ($total_keywords - 1)) {
                $where .= " OR ";
            }
        }
        $result = $this->db_count_records($table, $column, $where);
        return $result;
    }

    public function Search($select, $table, $column, $keywords, $where = null, $orderby = null, $arrangement = null, $start = 0, $per_page = null) {
        $keywords = $this->db->real_escape_string($keywords);
        $keywords = preg_split('/[\s]+/', $keywords);
        $total_keywords = count($keywords);
        $where .= " AND ";
        foreach ($keywords as $key => $keyword) {
            $where .= "FROM_BASE64(".$column . ") LIKE '%" . $keyword . "%' ";
            if ($key != ($total_keywords - 1)) {
                $where .= " OR ";
            }
        }
        $result = $this->select($select, $table, $where, $orderby, $arrangement, $start, $per_page);
        return $result;
    }

}
