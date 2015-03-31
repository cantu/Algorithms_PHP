<?php
/**
 * Created by PhpStorm.
 * User: tusion
 * Date: 15-3-31
 * Time: 上午10:13
 */

namespace tusion\algorithms;


class TreeNode {
    public $data;
    public $left;
    public $right;

    function __construct( $data=null, $left=null, $right=null )
    {
        $this->data = $data;
        $this->left = $left;
        $this->right = $right;
    }

    function to_string()
    {
        if( $this->data === null )
        {
            echo" This node is null \n";
            return true;
        }

        echo "{ data:".$this->data.", left:".$this->left.", right:".$this->right." }\n";
        return true;
    }

}