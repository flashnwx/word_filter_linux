<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Content_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->test = $this->load->database('test',true);
    }

    /**
     * 插入一条内容
     */
    function add_content($params )
    {
        $res = $this->test->insert('content_list',$params);
        return $res;
    }

    /**
     * 获取提交的文章列表
     */
    function get_content_list()
    {
        $sql = "select * from `content_list` order by id desc";
         $res = $this->test->query($sql);
         return $res->result_array();
    }

}
