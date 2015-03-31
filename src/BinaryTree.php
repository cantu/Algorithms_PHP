<?php
/**
 * Created by PhpStorm.
 * User: tusion
 * Date: 15-3-23
 * Time: 下午8:11
 */

namespace tusion\algorithms;


require_once("./TreeNode.php");
require_once("./Utils.php");
class BinaryTree {
    protected $tree_degree;
    protected $root;

    function __constract( )
    {
        $this->root = null;
        $this->tree_degree = 0;
        $node_array = array();
    }

    function set_root( $root )
    {
        $this->root = $root;
        return true;
    }


    /**
     * 先序遍历,递归实现. (DLR, 根节点->左节点->右节点）
     * @param $root
     * @param $result_arr
     */
    function pre_order_traverse( $root, &$result_arr )
    {
        if( $root !== null )
        {
            $result_arr[] = $root->data;
            $this->pre_order_traverse( $root->left, $result_arr);
            $this->pre_order_traverse( $root->right,$result_arr);
        }
    }

    /**
     * 先序遍历,(DLR, 根节点->左节点->右节点）非递归实现.
     * 用数组模拟栈,  array_push()尾进    array_pop()尾出
     * TODO 递归改为循环的地方还要好好思考学习下.
     * TODO 自己用链表实现一个栈来改写递归函数
     *
     * @param $root
     * @param $result_arr
     * @return bool
     */
    function pre_order_traverse_no_recursive( $root, &$result_arr)
    {
        if( $root === null )
        {
            echo "Error, input tree is not correct\n";
            return false;
        }
        //数组模拟栈, 取代递归方式.
        $stack = array();
        \array_push( $stack, $root);

        while( !empty( $stack))
        {
            $node = array_pop($stack);
            $result_arr[] = $node->data;

            if($node->right !== null )
            {
                \array_push($stack, $node->right);
            }

            if( $node->left !== null )
            {
                \array_push($stack, $node->left);
            }
        }
        return true;
    }

    /**
     * 中序遍历(LDR, 左节点->根节点->右节点）
     * @param $root
     * @param $result_arr
     */
    function in_order_traverse( $root, &$result_arr )
    {
        if( $root !== null )
        {
            $this->in_order_traverse( $root->left, $result_arr);
            $result_arr[] = $root->data;
            $this->in_order_traverse( $root->right,$result_arr);
        }
    }

    /**
     * 中序遍历(LDR, 左节点->根节点->右节点）非递归实现.
     * 用数组模拟栈,  array_push()尾进    array_pop()尾出
     * //TODO 这个非递归的实现比前序遍历安难多了,慢慢消化吧.
     * @param $root
     * @param $result_arr
     * @return bool
     */
    function in_order_traverse_no_recursive( $root, &$result_arr)
    {
        if( $root === null )
        {
            echo "Error, input tree is not correct\n";
            return false;
        }
        //数组模拟栈, 取代递归方式.
        $stack = array();
        \array_push( $stack, $root);

        $node = $root;
        while( $node !== null )
        {
            if($node->right !== null )
            {
                \array_push($stack, $node->right);
            }
            \array_push($stack, $node);
            if( $node->left !== null )
            {
                \array_push($stack, $node->left);
            }
            $node = $node->left;
        }
        $node = \array_pop( $stack );
        while(!empty($stack))
        {

            $result_arr[] = $node->data;
            //\array_push($stack, $node);
        }
        return true;
    }


    //后序遍历(LRD, 左节点->右节点->根节点）
    function post_order_traverse( $root, &$result_arr )
    {
        if( $root !== null )
        {
            $this->post_order_traverse( $root->left, $result_arr);
            $this->post_order_traverse( $root->right, $result_arr);
            $result_arr[] = $root->data;
        }
    }



    //====================================== test ==============================================
    /**
     *    ******二叉树图****
     *      A                    *
     *     * *                   *
     *    *   *                  *
     *   B     C                *
     *        *                   *
     *       *                    *
     *      D                    *
     *       *                    *
     *         *E                *
     ******************
     * PHP- 链式二叉树的遍历---先序遍历（根,左,右）-中序遍历(左,根,右)-后序遍历(左,右，根)
     * 先 A B C D E
     * 中 B A D E C
     * 后 B E D C A
     * */
    function build_test_binary_tree()
    {
        $a_node = new TreeNode('A');
        $b_node = new TreeNode('B');
        $c_node = new TreeNode('C');
        $d_node = new TreeNode('D');
        $e_node = new TreeNode('E');
        $a_node->left = $b_node;
        $a_node->right = $c_node;
        $c_node->left = $d_node;
        $d_node->right = $e_node;
        $b_tree = new BinaryTree();
        $b_tree->set_root( $a_node);
        return $b_tree;
    }

    function unit_test()
    {
        $util = new Utils();
        echo"BinaryTree test(): \n";
        $util->probe_start();
        //$mem_start = \memory_get_usage();
        //echo"before test memory used: ".$mem_start."\n";
        $b_tree = $this->build_test_binary_tree();

        $array_node = array();
        $this->pre_order_traverse( $b_tree->root, $array_node );
        echo "pre_order_traverse: { ".\implode(', ', $array_node )." } \n";

        $array_node = array();
        $this->in_order_traverse( $b_tree->root, $array_node );
        echo "in_order_traverse: { ".\implode(', ', $array_node )." } \n";

        $array_node = array();
        $this->post_order_traverse( $b_tree->root, $array_node );
        echo "post_order_traverse: { ".\implode(', ', $array_node )." } \n";

        echo"\n";
        $array_node = array();
        $this->pre_order_traverse_no_recursive( $b_tree->root, $array_node );
        echo "pre_order_traverse_no_recursive: { ".\implode(', ', $array_node )." } \n";

        $array_node = array();
        $this->in_order_traverse_no_recursive( $b_tree->root, $array_node );
        echo "in_order_traverse_no_recursive: { ".\implode(', ', $array_node )." } \n";


        $util->probe_end();
        $util->probe_result();

        //$mem_end = \memory_get_usage();
        //echo"after test memory used: ".$mem_end."\n";
        //echo"cost memory: ".($mem_end-$mem_start)."\n";
    }

    //TODO 性能测试工具xhprof没有调试通, 破坏php-fpm启动时不能加载
    /*
        //开启xhprof并开始记录
        xhprof_enable();
        //运行一些函数
        foo();
        //停止记录并取到结果
        $xhprof_data = xhprof_disable();
     */

}

//当继承时,运行下面的单元测试,会先调用父类的unit_test()
//加入执行环境判断后,就只执行这个子类的测试.
if( \realpath( $argv[0]) === \realpath(__FILE__))
{
    $b_tree = new BinaryTree();
    $b_tree->unit_test();
}
