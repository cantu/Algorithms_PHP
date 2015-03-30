<?php
/**
 * Created by PhpStorm.
 * User: tusion
 * Date: 15-3-30
 * Time: 上午10:46
 */

namespace tusion\algorithms;

require_once './Node.php';
require_once './LinkList.php';

class DoubleLinkList extends LinkList{
    //private $pre_node;

    function __constract()
    {
        parent::__construct();
        $this->pre_node = null;
    }

    function __descontract()
    {
        parent::__destruct();
    }

    function add_node( $data )
    {
        if( $data === null)
        {
            echo"Error, input data is null\n";
            return false;
        }
        if( $this->last_node === null)
        {
            $this->last_node = new Node( $data, null, null);
            if( $this->header === null )
            {
                $this->header = $this->last_node;
            }
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





    /**
     * 单元测试
     */
    public static function unit_test( )
    {
        echo"basic test from LinkList:\n";
        parent::unit_test();

        echo"test from DoubleLinkList unit test: \n";

    }
}

//当继承时,运行下面的单元测试,会先调用父类的unit_test()
//加入执行环境判断后,就只执行这个子类的测试.
if (realpath($argv[0]) == realpath(__FILE__))
{
    exit(DoubleLinkList::unit_test());
}