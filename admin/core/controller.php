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
        $c_string = $this->db->real_escape_string(htmlspecialchars(strip_tags(trim($string)), ENT_QUOTES, 'UTF-8'));
        return $c_string;
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
    public function select($select, $table, $where = null, $orderby = null, $arrangement = null, $start = null, $per_page = null) {
        ($start != null && $per_page != null) ? $limit = ' LIMIT ' . $start . ',' . $per_page : $limit = null;
        $orderby = ($orderby != null ) ? 'ORDER BY ' . $orderby : null;
        $sql = 'SELECT DISTINCT ' . $select . ' FROM ' . $table . ' ' . $where . ' ' . $orderby . ' ' . $arrangement . ' ' . $limit;
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
     * Insert data in the database table
     * @param string $table_name
     * @param array $prepar
     * @param string $cond
     * @return boolen
     */
    function insert($table, $coulmns, $cond = "") {
        foreach ($coulmns as $col => $value) {
            $prepared_cols [] = "`" . $this->filtrate($col) . "`";
            $prepared_values [] = "'" . $value . "'";
        }
        $set_cols = implode(',', $prepared_cols);
        $set_values = implode(',', $prepared_values);
        $query = 'INSERT INTO ' . $table . ' (' . $set_cols . ') VALUES (' . $set_values . ') ' . $cond;
        if ($this->db->query($query)) {
            return $this->db->insert_id;
        } else {
            return $this->db->error;
        }
    }

    /**
     * Multi Insert data in the database table
     * @param string $table_name
     * @param array or string $coulmns ex.(firstname,lastname)
     * @param string $values ex.('Fred','Smith'),('John','Smith')
     * @param string $cond
     * @return boolen
     */
    function multi_insert($table, $coulmns, $values, $cond = '') {
        (is_array($coulmns)) ? $coulmns = implode(',', $coulmns) : null;
        $query = "INSERT INTO " . $table . " (" . $coulmns . ") values " . $values;
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
            $binding[] = "`" . $col . "`='" . $value . "'";
        }
        $statment = implode(',', $binding);
        $query = 'UPDATE ' . $table . ' SET ' . $statment . ' ' . $cond;
        if ($this->db->query($query)) {
            return true;
        } else {
            return $this->db->error;
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
        $ids = is_array($ids) ? implode(',', $ids) : $ids;
        return update($table, array('feature' => 1), 'WHERE id IN (' . $ids . ')');
    }

    /**
     * unfeature multi records
     * @param string $table database table name
     * @param string $ids the ids for delete seprated by comas(,)
     * @return int count of efficted rows
     */
    function unfeature($table, $ids) {
        $ids = is_array($ids) ? implode(',', $ids) : $ids;
        return update($table, array('feature' => 0), 'WHERE id IN (' . $ids . ')');
    }

    /**
     * delete multi records
     * @param string $table database table name
     * @param array/string $ids the ids for delete seprated by comas(,)
     * @return int count of efficted rows
     */
    function delete($table, $ids) {
        $ids = is_array($ids) ? implode(',', $ids) : $ids;
        $query = 'DELETE from ' . $table . ' WHERE id IN (' . $ids . ')';
        if (!$this->db->query($query)) {
//            trigger_error("Query Failed: (" . $db->errno . ") " . $db->error, E_USER_ERROR);
        } else {
            return $this->db->affected_rows;
        }
    }

    /**
     * count total rows
     * @param string $table database table
     * @param string $cond condation statment
     * @return int count of records
     */
    function db_count_records($table, $cond = "") {
        $sql = 'SELECT COUNT(id) as id FROM ' . $table . ' ' . $cond;
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

    /*     * ************************** Tools functions *********************************** */

    /**
     * redirect to spesefic page
     * @param string $url
     */
    function redirect_to($url) {
        if (!headers_sent()) {
            header('Location: ' . $url);
            exit;
        } else {
            echo '<script type="text/javascript">';
            echo 'window.location.href="' . $url . '";';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="0;url=' . $url . '" />';
            echo '</noscript>';
            exit;
        }
    }

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

}
