<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: niweixing
 * Date: 2019/5/18
 * Time: 23:18
 */

require_once  __DIR__.'/'.'Trie.php';

class  WordFilter extends  CI_Controller{

    function index(){
        $this->load->view('tire_index');
        // $this->load->view('welcome_message');
    }

    function word_filter(){
        //var_dump($_REQUEST);exit;
        $post_data = $_REQUEST ;
        $handle = fopen(__DIR__.'/'.'dict.txt', 'r');
        $trie = new Trie();
        while (!feof($handle)) {
            $word = rtrim(fgets($handle));
            if (!empty($word)) {
                $trie->insert($word);
            }
        }
        fclose($handle);

        $start = microtime(true);
        $res = $trie->search_all($post_data['content']);  //内容敏感词过滤
        $end = microtime(true);

        if(!empty($res)){
            echo '内容中含有敏感词'.'【'.$res[0].'】'."</br>";
            $post_data['status'] = 3 ;
        }else{
            $post_data['status'] = 1 ;
        }

        $use_time = floatval( $end - $start)*1000 ;
        echo  '敏感词检测使用时间：'.$use_time.'毫秒'."</br>";
           // var_dump(floatval( $end - $start));
        echo '使用内存：'.(memory_get_peak_usage() / 1024 / 1024) . 'M'."</br>";

            //内容入库
         $this->load->model('Content_model');
         $post_data['ctime'] = date("Y-m-d H:i:s");
         $res = $this->Content_model->add_content($post_data);

        echo  $res? '入库成功': '入库失败' ;

    }


    public function content_list(){
        $this->load->model('Content_model');
        $res = $this->Content_model->get_content_list();
       // var_dump($res);
        $this->view['data']=$res;
        $this->load->view('content_list',$this->view);
    }

}








