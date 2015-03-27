<?php
/**
 * Created by PhpStorm.
 * User: tusion
 * Date: 15-3-26
 * Time: 上午11:14
 */

namespace tusion\algorithms;


class ArrayUtils {

    public $small_number_array = array( 7, 5, 6,2,3, 1, 4, 9, 8);


    function __construct()
    {
        ;
    }

    function __descontruct()
    {
        ;
    }

    /**
     * 按照格式输出数组
     * @param $arr
     * @param $is_assist:为true时输出为关联数组，为false时输出简单格式。
     * @return bool
     */
    function output( $arr, $is_assist )
    {
        if( !is_array($arr))
        {
            echo ("input data must a array to Outputarray();\n");
            return false;
        }
        $length = count( $arr );
        $out_str = 'array:{ ';
        if( $is_assist )
        {
            for( $i=0; $i<$length; $i++)
            {
                $out_str = $out_str.'['.$i.']:'.$arr[$i].', ';
            }
            $out_str = substr( $out_str,0, -2);
            $out_str .= "}\n";
        }
        else
        {
            for($i=0; $i<$length; $i++)
            {
                $out_str = $out_str.$arr[$i].', ';
            }
            $out_str = substr( $out_str,0, -2);
            $out_str = $out_str."}\n";
        }
        echo $out_str;
    }


    /**
     * 检查输入数组是否递增排列
     * @param $arr
     * @return bool： true是递增数列， false不是递增数列
     * @throws \Exception
     */
    function check_is_increasing_order( $arr )
    {
        //check input array;
        if( !\is_array( $arr ))
        {
            throw new \Exception( "Input check data must a array");
        }
        $length = \count( $arr);
        if( $length <= 1 )
        {
            return True;
        }
        else
        {
            for( $i=0; $i<$length-1; $i++)
            {
                if( $arr[$i]> $arr[$i+1])
                {
                    return false;
                }
            }
            return true;
        }
    }
}