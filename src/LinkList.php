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

    private $header ;
    private $last_node ;
    private $length ; //链表长度
    private static $is_debug = true; //控制调试输出，打印更多信息

    function __construct()
    {
        $this->header = null;
        $this->last_node = null;
        $this->length = 0;

    }

    function __destruct()
    {
        ;
    }


    /**
     * 在链表后面添加一个元素
     * @param $data
     */

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
            $this->last_node->next = new Node( $data, null, null);
            $this->last_node = $this->last_node->next;
        }
        $this->length++;
    }

    function add_node_at_head( $data )
    {
        if( $data === null )
        {
            echo "add data is invalid\n";
            return false;
        }
        $new_head_node = new Node( $data, $this->header, null );
        $this->header = $new_head_node;
        $this->length++;
        return true;
    }

    /**
     * 删除链表中的某一个元素
     * @param $data
     * @return bool
     */
    function del_node( $data )
    {
        if( $data == null )
        {
            echo"error: to delete element is not correct;\n";
            return false;
        }

        $pre_node = null;
        for( $cur_node = $this->header; $cur_node!=null; $cur_node = $cur_node->next )
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
        }
        return false;

    }

    /**
     *  将链表中的某一个值更新为另一个值
     * @param $old_value
     * @param $new_value
     * @return bool
     */
    function update_value( $old_value, $new_value )
    {
        if( $old_value == null || $new_value == null )
        {
            return false;
        }
        if( $this->header==null || $this->length==0)
        {
            return false;
        }
        for( $node=$this->header; $node!=null; $node=$node->next)
        {
            if( $node->data == $old_value )
            {
                $node->data = $new_value;
                return true;
            }
        }
        return false;
    }

    /**
     * 遍历链表
     * @return array|null: 返回链表元素组成的数组.
     */
    function traversal()
    {
        $arr = array();
        if( $this->header == null )
            return null;

        if( $this->length <=0 )
        {
            return null;
        }
        for( $node=$this->header; $node !=null; $node=$node->next)
        {
            $arr[] = $node->data;
        }
        return $arr;
    }

    /**
     * 搜索某个元素是否在链表中
     * @param $value
     * @return bool
     */
    function search_node( $value )
    {
        if( $value == null )
        {
            return false;
        }
        for( $node=$this->header; $node!=null; $node = $node->next)
        {
            if( $value == $node->data )
            {
                return true;
            }
        }
        return false;
    }



    /**
     * 打印链表元素
     */
    function to_string()
    {
        if( $this->header == null )
        {
            echo "List is empty\n";
            return null;
        }
        $arr = $this->traversal( );
        if( is_array($arr) )
        {
            $string = \implode(", ", $arr);
            echo $string."\n";
            return $string;
        }
        else
        {
            echo "List is empty\n";
            return null;
        }

    }

    /**
     * 获取当前链表长度
     * @return int
     */
    function get_length()
    {
        return $this->length;
    }

    /**
     * 测试链表是否为空
     * @return bool
     */
    function is_empty()
    {
        if( $this->header===null or $this->length==0)
        {
            return true;
        }
        else
        {
           return false;
        }
    }

    //清空链表, 理解为一个元素一个元素的删除
    function clear_list()
    {
        if( ! $this->is_empty() )
        {
            $pre_node = null;
            for($node=$this->header; $node!==null; $node=$pre_node->next)
            {
                $pre_node = $node;
                $pre_node->next = $node->next;
                $this->length--;
                if( self::$is_debug)
                {
                    echo "clear list: size: ".$this->length.", unset:".$node->data."\n";
                }
                unset( $node );
            }
            //删除链表第一个元素
            if( $pre_node !== null )
            {
                unset( $pre_node);
            }
            if( $this->header !== null)
            {
                unset( $this->header);
            }
            if( $this->last_node !== null)
            {
                unset( $this->last_node);
            }

        }
    }

    //测试一个链表是否有环
    function cycle_detect( $list )
    {
        ;
    }

    function set_debug( $is_debug)
    {
        if( $is_debug === true )
        {
            self::$is_debug = true;
        }
        else
        {
            self::$is_debug == false;
        }
    }
    /**
     * 单元测试
     */
    public static function unit_test()
    {
        $list =  new LinkList();
        $list->set_debug( true);
        /*
        for( $i=0; $i<10; $i++)
        {
           $list->add_node( \rand(1,10));
            //$list->add_node( $i );
        }
        */
        $list->add_node(3);
        $list->add_node(2);
        $list->add_node(1);
        $list->to_string();
        echo"list size: ".$list->get_length()."\n";


        if( $list->search_node(1) )
        {
            echo"success searched 1:  ";
            $list->to_string();
        }

        if( $list->del_node(2))
        {
            echo"success delete 2:  ";
            $list->to_string();
        }
        if( $list->del_node(1) )
        {
            echo"success delete 1: ";
            $list->to_string();
        }


        if( $list->search_node(3) )
        {
            echo"success searched 1:  ";
            $list->to_string();
        }
        $list->update_value(3,1);
        $list->to_string();
        $list->del_node(1);

        $list->clear_list();
        $list->to_string();
        if( $list->is_empty() )
        {
            echo "is_empty test is ok\n";
        }
        else
        {
            echo "is_empty test failed \n";
        }

        for($i=0; $i<50000; $i++)
        {
            $list->add_node_at_head( $i);
        }
        $list->to_string();
        $list->clear_list();
        $list->to_string();
    }


}

LinkList::unit_test();


