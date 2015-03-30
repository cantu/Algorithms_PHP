<?php
/**
 * Created by PhpStorm.
 * User: tusion
 * Date: 15-3-30
 * Time: 上午10:46
 */

namespace tusion\algorithms;

require_once './Node.php';
class DoubleLinkList {
    private $header;
    private $last_node;
    private $length;

    function __constract()
    {
        $this->header = null;
        $this->last_node = null;
        $this->length = 0;
    }

    function __descontract()
    {
        ;
    }

    function add_node( $data )
    {
        if( $data === null)
        {
            return false;
        }
        if( $this->last_node === null)
        {
            $this->last_node = new Node( $data, null, null);
            $this->header = $this->last_node;
        }
        else
        {

            $this->last_node->next= new Node( $data, null, $this->last_node);
            //$this->last_node->pre = $pre_node;
            $this->last_node = $this->last_node->next;

        }
        $this->length++;
        return true;
    }

    function traversal(  )
    {
        if( $this->header === null )
        {
            return null;
        }
        if( $this->length <= 0 )
        {
            return null;
        }
        $arr = array();
        for( $node=$this->header; $node!=null; $node=$node->next)
        {
            $arr[] = $node->data;
        }
        return $arr;
    }

    function

    function to_string( )
    {
        if( $this->header === null)
        {
            echo"Error, list is null\n";
            return null;
        }
        $arr = $this->traversal( );
        if( \is_array( $arr ) )
        {
            $str = \implode(', ', $arr);
            echo $str." \n";
            return $str;

        }
        else
        {
            echo"List is empty;\n";
            return null;
        }

    }

    /**
     * 单元测试
     */
    public static function unit_test( )
    {
        $double_list = new DoubleLinkList();
        for($i=1; $i<4; $i++)
        {
            $double_list->add_node( $i );
        }
        //\var_dump( $double_list);
        $double_list->to_string();
    }
}

DoubleLinkList::unit_test();