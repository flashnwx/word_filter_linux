<?php

/**
 * Created by PhpStorm.
 * User: niweixing
 * Date: 2019/5/18
 * Time: 11:44
 */
class Node
{
    public $value = null;
    public $children = array();
}
class Trie
{
    public $root;
    public $max_len;

    /**
     * Trie constructor.
     */
    public function __construct()
    {
        $this->root = new Node();
        mb_internal_encoding("UTF-8");
    }

    /**
     * @param $word
     * 字典数具体的插入构建
     */
    public function insert($word)
    {
        $node =& $this->root;
        $word_len = mb_strlen($word);
        if ($word_len> $this->max_len) {
            $this->max_len = $word_len;
        }
        for ($i=0; $i<$word_len; $i++) {
            $char = mb_substr($word, $i, 1);
            if (!array_key_exists($char, $node->children)) {  //当前不存在的字符，新建 一个node
                $child = new Node();
                $node->children[$char] = $child;
                $node =& $node->children[$char];
            } else {
                $node =& $node->children[$char];
            }
        }
        $node->value = $word;
    }

    /**
     * @param
     * 读敏感词文件，字典树
     */
    public function load_words($file)
    {
        $handle = fopen($file, 'r');
        while (!feof($handle)) {
            $word = rtrim(fgets($handle));  //一行行获取，一行一个敏感词
            if (!empty($word)) {
                $this->insert($word);
            }
        }
        fclose($handle);
    }
    /**
     * 单个字符匹配
     * @param $word
     * @return null
     */
    public function search($word)
    {
        $node = $this->root;
        $word_len = mb_strlen($word);
        for ($i=0; $i<$word_len; $i++) {
            $char = mb_substr($word, $i, 1);
            if (!array_key_exists($char, $node->children)) {
                return $node->value;
            } else {
                $node = $node->children[$char];
            }
        }
        return $node->value;
    }

    /**
     * 字符串文本匹配
     * @param $text
     * @return array
     */
    public function search_all($text)
    {
        $result = array();
        $str_len = mb_strlen($text);
        for ($i = 0; $i <$str_len ; $i++) {
            $search_word = mb_substr($text, $i, $this->max_len);
            $filter_word = $this->search($search_word);
            if ($filter_word) {
                $result[] = $filter_word;
            }
        }
        return array_unique($result);
    }
}