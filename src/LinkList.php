<?php
/**
 * Created by PhpStorm.
 * User: tusion
 * Date: 15-3-26
 * Time: 上午10:04
 */

namespace tusion\algorithms;

require_once './LinkNode.php';
require_once './Utils.php';

/**
 * Class LinkList
 * @package tusion\algorithms
 */
class LinkList {

    protected $header ;
    protected $last_node ;
    protected $length ; //链表长度
    protected static $is_debug = true; //控制调试输出，打印更多信息

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
     * @return bool
     */
    function add_node( $data )
    {
        if($data === null )
        {
            echo"Error, input data is null\n";
            return false;
        }
        if( $this->last_node === null )
        {
            $this->last_node = new LinkNode( $data,null, null);
            if( $this->header === null )
            {
                $this->header = $this->last_node;
            }
        }
        else
        {
            $this->last_node->next = new LinkNode( $data, null, null);
            $this->last_node = $this->last_node->next;
        }
        $this->length++;
        return true;
    }

    function add_node_at_head( $data )
    {
        if( $data === null )
        {
            echo "add data is invalid\n";
            return false;
        }
        $new_head_node = new LinkNode( $data, $this->header, null );
        $this->header = $new_head_node;
        $this->length++;
        return true;
    }

    /**
     * 删除链表中的某一个元素
     * 这种遍历算法的时间复杂度 O(n/2)
     * @param $data
     * @return bool
     */
    function del_node( $data )
    {
        if( $data === null )
        {
            echo"error: to delete element is not correct;\n";
            return false;
        }

        $pre_node = null;
        for( $cur_node = $this->header; $cur_node!=null; $cur_node = $cur_node->next )
        {
            if( $cur_node->data == $data )
            {
                if( $pre_node === null )
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
     * TODO:O(1)的时间内删除链表中的一个元素;
     * 当需要删除节点的指针时,我们可以把下溢节点的内容复制到这个节点,然后释放下一节点即可.
     * <<剑指offer>>13题
     * @param $data
     */
    function del_node_fast( $data )
    {
        ;
    }

    /**
     *  将链表中的某一个值更新为另一个值
     * @param $old_value
     * @param $new_value
     * @return bool
     */
    function update_value( $old_value, $new_value )
    {
        if( $old_value === null || $new_value === null )
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
        if( $this->header === null )
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
     * 搜索某个元素在链表中的位置.
     * @param $value
     * @return null
     */
    function search_node( $value )
    {
        if( $value === null )
        {
            return null;
        }
        for( $node=$this->header; $node!=null; $node = $node->next)
        {
            if( $value == $node->data )
            {
                return $node;
            }
        }
        return null;
    }



    /**
     * 打印链表元素
     */
    function to_string()
    {
        if( $this->header === null )
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
     *反转打印链表元素,链表保持原样.
     *TODO:用栈实现反转打印
     * <<剑指offer>>第5题
     */
    function to_reversal_string_use_stack()
    {
        ;
    }

    /**
     *反转打印链表元素,链表保持原样.
     *TODO:用递归实现反转打印
     * <<剑指offer>>第5题
     */
    function to_reversal_string_use_recursion()
    {
        ;
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




    function set_debug( $is_debug)
    {
        if( $is_debug === true )
        {
            self::$is_debug = true;
        }
        else
        {
            self::$is_debug = false;
        }
    }

    /**
     * 输入一个链表,返回链表中倒数第K个节点,不用两遍遍历链表.
     * 定义两个相距K-1的指针,移动步长都是1,头指针到K-1个节点时,两个指针一起向前走.
     * 当头指针到队尾时,后面的指针在倒数第K个元素
     * 比如链表为:1,2,3,4,5,6, 输出倒数第3个节点,就输出4
     * <<剑指offer>>15题
     * @param $last_k: 倒数第K个元素.
     * @return null
     */
    function get_last_k_node(  $last_k )
    {
        if($this->header=== null )
        {
            echo"Error: this link list is null.\n";
            return null;
        }
        if( $last_k <= 0)
        {
            echo"Error: input last k should be bigger than 0 \n";
            return null;
        }

        $ahead_pointer = $this->header;
        $behind_pointer = $this->header;
        for($i=0; $i<$last_k; $i++)
        {
            //链表长度没有K值那么长
            if( $ahead_pointer === null )
            {
                echo"Error: this link list length just ".($i+1).", input K is too large.\n";
                return null;
            }
            $ahead_pointer = $ahead_pointer->next;
        }
        //两个指针相距(K-1)时,一起向前移动,直到头指针到达队尾.
        while( $ahead_pointer!== null )
        {
            $ahead_pointer = $ahead_pointer->next;
            $behind_pointer = $behind_pointer->next;
        }
        return $behind_pointer->data;
    }

    /**
     * TODO:查找链表的中间节点
     * 定义两个指针,从头节点开始,一个步长为1,一个步长为2
     * 则当走的快的指针到链表尾端是,慢的指针则是中间节点
     */
    function get_mid_node()
    {
        ;
    }


    /**
     * TODO::合并两个排列有序的链表
     * <<剑指offer>>17题
     * @param $list:需要合并的另外一个链表
     */
    function merge_list( $list )
    {
        ;
    }
    /**
     * TODO:测试一个链表是否有环
     * 定义两个指针,从头节点开始,一个步长为1,一个步长为2
     * 如果走的快的指针和走的慢的指针相遇,则有环行链表.
     * 如果走的快的指针走到队尾都还没有和慢指针相遇,则没有环.
     */
    function is_cycle( )
    {
        ;

    }



    /**
     * 反转链表
     * 只要一个一个O(2)的辅助变量存住上一个和下一个节点,
     * <<剑指offer>>16题
     * @return null
     */
    function reversal()
    {
        if( $this->header === null )
        {
            echo"Error: this link list is null\n";
            return null;
        }
        if( $this->get_length() === 1)
        {
            return $this->header;
        }

        $pre_node = $this->header;
        $node = $pre_node->next;
        while( $node !== null )
        {
            $next_node = $node->next;
            $node->next = $pre_node;
            $pre_node = $node;
            $node = $next_node;
        }

        $this->header->next = null;
        $this->header = $pre_node;
        return $this->header;
    }




    /**
     * 单元测试
     */
    public static function unit_test()
    {
        $list =  new LinkList();
        $list->set_debug( true);

        for( $i=0; $i<4; $i++)
        {
           //$list->add_node( \rand(1,10));
           $list->add_node( $i );
        }


        $list->to_string();
        echo"list size: ".$list->get_length()."\n";

        $node = $list->search_node(1);
        if( $node != null )
        {
            echo"success searched data:  ".$node->data."\n";
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


        $list->update_value(0,555);
        echo 'update 0 to 555: '.$list->to_string()."\n";
        $list->del_node(555);

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

        $list->set_debug( false );
        $util = new Utils();
        $util->probe_result();
        for($i=0; $i<20000; $i++)
        {
            $list->add_node_at_head( $i);
        }
       // $list->to_string();
        $list->clear_list();
       // $list->to_string();
        $util->probe_end();
        $util->probe_result();

        //查找倒数第K个数
        echo "\nget last k data:\n";
        $list->clear_list();
        for( $i=0; $i<7; $i++)
        {
            $list->add_node( $i );
        }
        $list->to_string();
        $last_k_data = $list->get_last_k_node(3 );
        echo "k=3, data = ".$last_k_data."\n";
        $last_k_data = $list->get_last_k_node(1);
        echo "k=1, data = ".$last_k_data."\n";
        $last_k_data = $list->get_last_k_node(7);
        echo "k=7, data = ".$last_k_data."\n";
        $last_k_data = $list->get_last_k_node(8);
        echo "k=8, data = ".$last_k_data."\n";

        //反转链表
        echo"\nreversal link list \n";
        $list->to_string();
        $list->reversal();
        echo"reversal: ";
        $list->to_string();
        $list->clear_list();
        //$list->add_node(1);
        //$list->add_node(2);
        $list->to_string();
        $list->reversal();
        echo"reversal: ";
        $list->to_string();



    }


}

//当继承时,运行下面的单元测试,会先调用父类的unit_test()
//加入执行环境判断后,就只执行这个子类的测试.
if (realpath($argv[0]) == realpath(__FILE__))
{
    exit(LinkList::unit_test());
}



