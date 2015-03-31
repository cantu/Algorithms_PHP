<?php
/**
 * Created by PhpStorm.
 * User: tusion
 * Date: 15-3-29
 * Time: 上午8:52
 */

namespace tusion\algorithms;


class LinkNode {
    public $data;
    public $next = null;
    public $pre = null;

    function __construct( $data=0, $next=null, $pre=null)
    {
        $this->data = $data;
        $this->next = $next;
        $this->pre = $pre;

    }

    function __destruct()
    {
        ;
    }

    /*
    function set_data( $data )
    {
        $this->data = $data;
    }

    function set_next ( $next )
    {
        $this->next = $next;
    }

    function set_pre( $pre )
    {
        $this->pre = $pre;
    }

    function get_data()
    {
        return $this->data;
    }

    function get_next()
    {
        return $this->next;
    }

    function get_pre()
    {
        return $this->pre;
    }
    */
    function to_string()
    {
        $node_str = "{ data:".$this->data.'; ';
        $node_str .= 'next: '.$this->next.'; ';
        $node_str .= 'pre: '.$this->pre."; }\n";
        echo $node_str;
    }

    public static function unit_test()
    {
        ;
    }
}


//当继承时,运行下面的单元测试,会先调用父类的unit_test()
//加入执行环境判断后,就只执行这个子类的测试.
if (realpath($argv[0]) == realpath(__FILE__))
{
    exit(LinkNode::unit_test());
}
