<?php

/*
 * @Developed by : Ahmed Mosa .
 * @Developer Site: http//www.elmosamem.com 
 */

class model extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function languages($columns = '*') {
        $result = $this->select($columns, 'languages', " WHERE status != '0' ");
        return $result;
    }

    public function works($columns = '*', $num_rows) {
        $result = $this->select($columns, 'works', " WHERE status != '0' ", 'id', 'DESC', 0, $num_rows);
        return $result;
    }

    public function works_RAND($columns = '*', $num_rows) {
        $result = $this->select($columns, 'works', " WHERE status != '0' ", 'RAND()', 'DESC', 0, $num_rows);
        return $result;
    }   

    public function project($columns = '*',$alias) {
        $result = $this->select($columns, 'works', " WHERE status != '0' AND alias = '".$alias."' ", 'id', 'DESC', '0', '1');
        return $result;
    }

    public function clients($columns = '*') {
        $result = $this->select($columns, 'clients', " WHERE status != '0' ");
        return $result;
    }

    public function article($alias) {
        $where = " WHERE articles.status != '0' AND articles.alias = '" . $alias . "' AND articles.user_id = users.id AND articles.category_id = categories.id ";
        $select = "articles.*,users.username,users.id as user_id,users.alias as user_alias,users.avatar as user_avater,users.about_me,categories.name as category_name,categories.alias as category_alias";
        $result = $this->select($select, 'articles,users,categories', $where, null, null, 0, 1);
        return $result;
    }

    public function articles_with_pagination($start = 0, $per_page = 10) {
        $where = " WHERE articles.status != '0' AND articles.user_id = users.id AND articles.category_id = categories.id ";
        $select = "articles.id,articles.title,articles.alias,articles.image,articles.content,articles.created,users.username,categories.name as category_name";
        $result = $this->select($select, 'articles,users,categories', $where, 'articles.id', 'DESC', $start, $per_page);
        return $result;
    }

    public function articles_with_pagination_by_category($category_id, $start = 0, $per_page = 10) {
        $where = " WHERE articles.status != '0' AND articles.user_id = users.id AND articles.category_id = '" . $category_id . "' GROUP BY articles.id ";
        $select = "articles.id,articles.title,articles.alias,articles.image,articles.content,articles.created,users.username,categories.name as category_name";
        $result = $this->select($select, 'articles,users,categories', $where, 'articles.id', 'DESC', $start, $per_page);
        return $result;
    }

    public function count_articles() {
        $where = " WHERE articles.status != '0' AND articles.user_id = users.id AND articles.category_id = categories.id ";
        $select = " articles.id ";
        $result = $this->db_count_records('articles,users,categories', $select, $where);
        return $result;
    }

    public function count_articles_by_category($category_id) {
        $where = " WHERE articles.status != '0' AND articles.user_id = users.id AND articles.category_id = '" . $category_id . "' ";
        $select = " articles.id ";
        $result = $this->db_count_records('articles,users,categories', $select, $where);
        return $result;
    }

    public function most_popular_articles($num_rows) {
        $where = " WHERE articles.status != '0' AND articles.user_id = users.id AND articles.category_id = categories.id ";
        $select = "articles.id,articles.title,articles.alias,articles.image,users.username,categories.name as category_name";
        $result = $this->select($select, 'articles,users,categories', $where, 'articles.hits', 'DESC', 0, $num_rows);
        return $result;
    }

    public function comments($article_id) {
        $result = $this->select('*', 'comments', " WHERE article_id = '" . $article_id . "' AND status != '0' ", 'id', 'DESC');
        return $result;
    }

    public function tags_in_article($article_id) {
        $result = $this->select('tag_id', 'articles_relation_tags', " WHERE article_id = '" . $article_id . "' ");
        if (is_array($result)) {
            $tags_ids = [];
            foreach ($result as $tags_id) {
                $tags_ids[] = $tags_id['tag_id'];
            }
            $result2 = $this->select('id,name,alias', 'articles_tags', " WHERE id IN (" . implode(',', $tags_ids) . ") AND status != '0' ");
            return $result2;
        } else {
            return FALSE;
        }
    }

    public function tags($article_id) {
        $result = $this->select('tag_id', 'articles_relation_tags', " WHERE article_id = '" . $article_id . "' ");
        if (is_array($result)) {
            $tags_ids = [];
            foreach ($result as $tags_id) {
                $tags_ids[] = $tags_id['tag_id'];
            }
            $result2 = $this->select('id,name', 'articles_tags', " WHERE id IN (" . implode(',', $tags_ids) . ") AND status != '0' ");
            return $result2;
        } else {
            return FALSE;
        }
    }

    public function work_tags($work_id) {
        $result = $this->select('tag_id', 'works_relation_tags', " WHERE work_id = '" . $work_id . "' ");
        if (is_array($result)) {
            $tags_ids = [];
            foreach ($result as $tags_id) {
                $tags_ids[] = $tags_id['tag_id'];
            }
            $result2 = $this->select('id,name', 'works_tags', " WHERE id IN (" . implode(',', $tags_ids) . ") AND status != '0' ");
            return $result2;
        } else {
            return FALSE;
        }
    }

    public function works_tags() {
        $result = $this->select('id,name', 'works_tags', " WHERE status != '0' ", 'id', 'DESC');
        return $result;
    }

    public function count_comments($article_id) {
        $result = $this->db_count_records('comments', 'id', " WHERE article_id = '" . $article_id . "' AND status != '0' ");
        return $result;
    }

    public function slideshow($columns = '*', $site_id = 0) {
        $result = $this->select($columns, 'slideshow', " WHERE status != '0' AND site_id = '" . $site_id . "' ", 'id', 'DESC');
        return $result;
    }

    public function page($columns = '*', $alias, $site_id = 0) {
        $result = $this->select($columns, 'pages', " WHERE alias = '" . $alias . "' AND status != '0' AND site_id = '" . $site_id . "' ", null, null, '0', '1');
        return $result;
    }

    public function quiz($columns = '*') {
        $result = $this->select($columns, 'quiz', " WHERE status != '0' ");
        return $result;
    }

    public function quiz_questions($columns = '*', $quiz_id) {
        $result = $this->select($columns, 'quiz_questions', " WHERE status != '0' AND quiz_id = '" . $quiz_id . "' ");
        return $result;
    }

    public function send_examinees($coulmns, $quiz_id, $ralation_array) {
        $result_send_examinees = $this->insert('quiz_examinees', $coulmns);
        if ($result_send_examinees) {
            $values = array();
            $examinees_id = $this->db->insert_id;
            foreach ($ralation_array as $id => $vid) {
                $values[] = '(' . $quiz_id . ',' . $id . ',' . $vid . ',' . $examinees_id . ',' . time() . ')';
            }
            $result = $this->multi_insert('quiz_examinees_results', 'quiz_id,quiz_questions_id,option_id,quiz_examinees_id,created_date', $values);
        }
        return ($result_send_examinees) ? $this->db->insert_id : false;
    }

    public function menus($columns = '*', $site_id = 0, $menu = 'm') {
        $id_list = $this->arrange_records('menus', " WHERE status = '1' AND site_id = '" . $site_id . "' AND menu = '" . $menu . "' ORDER BY level ASC ");
        if ($id_list > 0) {
            $ids = implode(',', $id_list);
            $where = " WHERE id IN (" . $ids . ") ORDER BY FIND_IN_SET(id,'" . $ids . "') ";
            $result = $this->select($columns, 'menus', $where);
            return $result;
        } else {
            return $id_list;
        }
    }

    public function send_contacts($coulmns) {
        $result = $this->insert('contacts', $coulmns);
        return ($result) ? $this->db->insert_id : false;
    }

    public function send_requests($coulmns) {
        $result = $this->insert('requests', $coulmns);
        return ($result) ? $this->db->insert_id : false;
    }

    public function send_comment($coulmns) {
        $result = $this->insert('comments', $coulmns);
        return ($result) ? $this->db->insert_id : false;
    }

    public function update_article_hits($hits, $article_id) {
        $coulmns = array('hits' => ($hits + 1));
        $result = $this->update('articles', $coulmns, " WHERE id = '" . $article_id . "' ");
        return ($result) ? true : false;
    }

    public function update_page_hits($hits, $page_id) {
        $coulmns = array('hits' => ($hits + 1));
        $result = $this->update('pages', $coulmns, " WHERE id = '" . $page_id . "' ");
        return ($result) ? true : false;
    }

    public function update_project_hits($hits, $project_id) {
        $coulmns = array('hits' => ($hits + 1));
        $result = $this->update('works', $coulmns, " WHERE id = '" . $project_id . "' ");
        return ($result) ? true : false;
    }

    public function articles_tags($columns = '*') {
        $result = $this->select($columns, 'articles_tags', " WHERE status != '0' ");
        return $result;
    }

    public function categories($columns = '*', $level = '1') {
        $result = $this->select($columns, 'categories', " WHERE status != '0' AND level = '" . $level . "' ");
        return $result;
    }

    public function categories_by_level($columns = '*', $country_id, $level) {
        is_array($level) ? implode(',', $level) : null;
        $level = trim($level, ",");
        $result = $this->select($columns, 'categories', " WHERE country_id = '" . (int) $country_id . "' AND level IN(" . $level . ") ");
        return $result;
    }

    public function category($columns = '*', $alias, $country_id) {
        $result = $this->select($columns, 'categories', " WHERE alias = '" . $alias . "' AND country_id = '" . $country_id . "' ", null, null, '0', '1');
        return $result;
    }

    public function categories_by_id($columns = '*', $ids) {
        is_array($ids) ? implode(',', $ids) : null;
        $ids = trim($ids, ",");
        $result = $this->select($columns, 'categories', " WHERE id IN (" . $ids . ") ");
        return $result;
    }

    public function subcategories_by_id($parent_id, $main_parent, $country_id, $arrangement = 'ASC') {
        $categories = $this->select('id,parent_id', 'categories', " WHERE main_parent = '" . (int) $main_parent . "' AND country_id = '" . $country_id . "' ", 'id');
        $id_list = ($arrangement == 'ASC') ? $this->Family_Tree_ASC($categories, $parent_id) : $this->Family_Tree_DESC($categories, $parent_id);
        $ids = $parent_id . ',';
        $ids .= ($id_list > 0) ? implode(',', $id_list) : 0;
        return $ids;
    }

    public function subcategories_by_level($columns = '*', $country_id, $cat_id, $level) {
        is_array($level) ? implode(',', $level) : null;
        $level = trim($level, ",");
        $result = $this->select($columns, 'categories', " WHERE country_id = '" . (int) $country_id . "' AND parent_id = '" . $cat_id . "' AND level IN(" . $level . ") ");
        return $result;
    }

    public function items_by_user($user_id = null, $status = null, $country_id = null) {
        $where = ' ';
        ($user_id != null) ? $where .= " WHERE realestates.user_id = '" . $user_id . "' " : null;
        ($status != null) ? $where .= " AND realestates.status != '" . $status . "' " : null;
        ($country_id != null) ? $where .= " AND realestates.country_id = '" . $country_id . "' " : null;
        $result = $this->select('realestates.*', 'realestates', $where, 'id', 'ASC');
        return $result;
    }

    public function items_by_featured($start, $per_page, $status = null) {
        $where = " WHERE realestates.featured = '1' AND realestates.user_id = users.id ";
        ($status != null) ? $where .= " AND realestates.status = '" . $status . "' " : null;
        $result = $this->select('classifieds.*,users.alias as user_alias', 'realestates,users', $where, 'id', 'ASC', $start, $per_page);
        return $result;
    }

    public function users($columns = '*') {
        $result = $this->select($columns, 'users');
        return $result;
    }

    public function user($columns = '*', $user_id) {
        $result = $this->select($columns, 'users', " WHERE id = '" . $user_id . "' ", null, null, '0', '1');
        return $result;
    }

    public function user_by_email($columns = '*', $email) {
        $result = $this->select($columns, 'users', " WHERE email = '" . $this->filtrate($email) . "' ", null, null, '0', '1');
        return $result;
    }

    public function user_by_alias($columns = '*', $alias) {
        $result = $this->select($columns, 'users', " WHERE status != '0' AND alias = '" . $this->filtrate($alias) . "' ", null, null, '0', '1');
        return $result;
    }

    public function register($coulmns, $where = "") {
        $result = $this->insert('users', $coulmns, $where);
        return ($result) ? $this->db->insert_id : false;
    }

    public function user_update($coulmns, $where = "") {
        $result = $this->update('users', $coulmns, $where);
        return ($result) ? true : false;
    }

    public function Update_Status($status, $ids) {
        is_array($ids) ? implode(',', $ids) : null;
        $prepard = array('status' => $status);
        $cond = ' WHERE id IN (' . $ids . ')';
        return ($this->update('realestates', $prepard, $cond)) ? true : false;
    }

    /**
     * Get the number of rows to natural case ...
     */
    public function Count_blog_search($keywords) {
        $where = " WHERE articles.status != '0' AND articles.user_id = users.id AND articles.category_id = categories.id ";
        $result = $this->Count_Search('articles,users,categories', 'articles.id', 'articles.title', $keywords, $where);
        return $result;
    }

    public function blog_search($keywords, $start = 0, $per_page = 10) {
        $where = " WHERE articles.status != '0' AND articles.user_id = users.id AND articles.category_id = categories.id ";
        $select = " articles.id,articles.title,articles.alias,articles.image,articles.content,articles.created,users.username,categories.name as category_name ";
        $result = $this->Search($select, 'articles,users,categories', 'articles.title', $keywords, $where, null, null, $start, $per_page);
        return $result;
    }

    public function Count_Rows($table, $where = null) {
        $result = $this->db_count_records($table, $where);
        return $result;
    }

    /**
     * calculate the total pages ..
     */
    public function total_pages($total_count, $per_page) {
        return $this->total_page($total_count, $per_page);
    }

    /**
     * calculate the start of page ..
     */
    public function start($current_page, $per_page) {
        $current_page = ($current_page < 1 ) ? 1 : $current_page;
        return $this->starter($current_page, $per_page);
    }

    public function pagination($total_pages, $current_page, $url) {
        return $this->create_pagination($total_pages, $current_page, $url);
    }

    /**
     * cut a words ..
     * @param string $words
     * @param int $statr_cut
     * @param int $length
     */
    public function Cut_Words($words, $length, $start_cut = 0) {
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

    public function Authenticate($coulmns, $email, $password) {
        $where = " WHERE email = '" . $this->filtrate($email) . "' AND password = '" . sha1($password) . "' AND status = '1' LIMIT 1 ";
        $result = $this->select($coulmns, 'users', $where);
        if ($result) {
            $_SESSION['Ta_User_Logged'] = 'yes';
            $_SESSION['Ta_User_Id'] = $result[0]['id'];
            $_SESSION['Ta_User_Name'] = $result[0]['username'];
            $_SESSION['Ta_User_Alias'] = $result[0]['alias'];
            $_SESSION['Ta_User_Email'] = $result[0]['email'];
            $_SESSION['user_cl_r_e']['disabled'] = false;
//            $_SESSION['user_cl_r_e']['uploadURL'] = IMAGES_USERS_PATH . $_SESSION['Ta_User_Alias'];
            return $result;
        } else {
            return false;
        }
    }

    public function Create_Lines($text) {
        $rep = array('\r\n', '\r', '\n', '\\');
        $text = str_replace($rep, '<br/>', $text);
        return $text;
    }

    public function Delete_Lines($text) {
        $rep = array('\r\n', '\r', '\n', '\\');
        $text = str_replace($rep, '', $text);
        return $text;
    }

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

    public function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }

}
