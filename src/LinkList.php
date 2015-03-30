<?php
/**
 * Created by PhpStorm.
 * User: tusion
 * Date: 15-3-26
 * Time: 上午10:04
 */

namespace tusion\algorithms;

require_once './Node.php';
class LinkList {

    private $header = null;
    private $last_node = null;
    private $length ; //链表

    function __construct($data=0, $next=null, $pre=null)
    {
        $this->last_node = new Node( $data, $next, $pre);
        $this->header = $this->last_node;
        $this->length = 0;
    }

    function __destruct()
    {
        ;
    }


    function add_node( $data )
    {
        if( $this->last_node == null )
        {
            $this->last_node = new Node( $data,null, null);
            if( $this->header == null )
            {
                $this->header = $this->last_node;
            }
        }
        else
        {
            $this->last_node->data = $data;
            $new_node = new Node( 0, null, null);
            $this->last_node->next = $new_node;
            $this->last_node = $new_node;
        }
        $this->length++;
    }

    function del_node( $data )
    {
        if( $data == null )
        {
            echo"error: to delete element is not correct;\n";
            return false;
        }

        $cur_node = $this->header;
        $pre_node = null;
        while ( $cur_node->next != null )
        {

            if( $cur_node->data == $data )
            {
                if( $pre_node == null )
                {
                    $this->header = $cur_node->next;
                }
                else
                {
                    $pre_node->next = $cur_node->next;
                }
                $this->length--;
                return true;
            }
            $pre_node = $cur_node;
            $cur_node = $cur_node->next;
        }
        return false;

    }

    function update_value( $old_value, $new_value )
    {
        ;
    }

    function traversal($list)
    {
        $arr = array();
        if( $list == null )
            return null;

        if( $this->length <=0 )
        {
            return null;
        }
        for( $node=$this->header; $node->next!=null; $node=$node->next)
        {
            $arr[] = $node->data;
        }

        return $arr;
    }

    function search_node( $value )
    {
        ;
    }

    function get_head( $list )
    {
        ;
    }

    function get_length()
    {
        return $this->length;
    }

    function to_string()
    {
        if( $this->header == null )
        {
            echo "List is empty\n";
        }
        $arr = $this->traversal( $this->header );
        $string = \implode(", ", $arr);
        echo $string."\n";
    }

    public static function unit_test()
    {
        $list =  new LinkList();
        for( $i=0; $i<10; $i++)
        {
            $list->add_node( random)
        }
        $list->to_string();

        $list->del_node(2);
        $list->to_string();
        $list->del_node(1);
        $list->to_string();
    }
}

LinkList::unit_test();


