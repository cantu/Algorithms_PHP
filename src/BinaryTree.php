<?php
/**
 * Created by PhpStorm.
 * User: tusion
 * Date: 15-3-23
 * Time: 下午8:11
 */

namespace algorithms;


class BinaryTree {

    public $data = null ;
    public $LefeHand = null; //左指针
    public $RightHand = null; //右指针

    function __constract( $data )
    {
        if( !empty($data))
        {
            $this->$data = $data;
        }
    }

    function addNode( $v)
    {
        $node = new BinaryTree( $v);
        if( $v <= $this->$data)
        {

        }
    }
    //先序遍历  （DLR）
    function PreTraverseWithRecursion( $BTree)
    {

    }


}