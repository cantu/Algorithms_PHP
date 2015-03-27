<?php
/**
 * Created by PhpStorm.
 * User: tusion
 * Date: 15-3-26
 * Time: 上午9:27
 */

namespace tusion\algorithms;

require_once './ArrayUtils.php';
/**
 * Class Sorter
 * 基本排序算法的PHP实现
 * @package algorithms
 */
class Sorter {

    private $ArrayUtil;
    private static $is_debug = true; //控制调试输出，打印更多信息

    function __construct()
    {
        $this->ArrayUtil = new ArrayUtils();
        self::$is_debug = true;
        //echo "construct(); \n";
    }

    function __destruct()
    {
        //echo"destruct(); \n";
    }

    /**
     * 控制调试输出，打印更多信息
     * @param $is
     * @return bool
     */
    function set_debug( $is )
    {
        if( is_bool( $is))
        {
            self::$is_debug = $is;
            return true;
        }
        else
        {
            echo ' set debug input is not correct.';
            return false;
        }
    }

    /**
     * 冒泡排序
     * @param $arr
     * @return array
     * @throws \Exception
     */
    function bubble_sort( $arr )
    {
        //check input array
        if( !\is_array( $arr ))
        {
            throw new \Exception( "Input Sorter must a array");
        }
        if( count( $arr) <=1 )
        {
            return $arr;
        }

        $length = count( $arr);
        for( $i=0; $i<$length; $i++)
        {
            for( $j=($length-1); $j>$i; $j--)
            {
                //输出递增数组
                if( $arr[$j] < $arr[$j-1])
                {
                    //swap( $arr[$j], $arr[$j-1] );
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j-1];
                    $arr[$j-1] = $temp;
                    if( self::$is_debug )
                    {
                        echo 'step'.$i.'-'.$j.':';
                        $this->ArrayUtil->output( $arr, false);
                    }
                }
            }
        }

        return $arr;
    }

    /**
     * 插入排序
     * 每次从待排列的数据中取出一个数据，插入到前面已经排好序的数列中的适当的位置，使手里的数列依然有序；
     * 直到待排序的数据元素全部插入完成为止。
     * @param $arr
     * @return array
     * @throws \Exception
     */
    function insert_sort( $arr )
    {
        //check input array;
        if( !\is_array( $arr ))
        {
            throw new \Exception( "Input Sorter must a array");
        }
        if( count( $arr) <=1 )
        {
            return $arr;
        }

        $length = count( $arr );
        for($i=1; $i<$length; $i++)
        {
            $key = $arr[$i];
            for($j=$i-1; $j>=0; $j--)
            {
                if(  $key< $arr[$j] )
                {
                    //依次往后移动
                    $arr[$j+1] = $arr[$j];
                    $arr[$j] = $key;
                }
                //打印输出
                if( self::$is_debug )
                {
                    echo 'step'.$i.'-'.$j.':';
                    $this->ArrayUtil->output( $arr, false);
                }
            }

        }
        return $arr;
    }


    /**
     * 选择排序：
     * 每一趟从待排序的数据元素中选出最小（最大）的一个元素，顺序放在已排好序的数列的最后，直到全部待排序的数据元素排完。
     * @param $arr
     * @return array
     * @throws \Exception
     */
    function select_sort( $arr )
    {
        //check input array;
        if( !\is_array( $arr ))
        {
            throw new \Exception( "Input Sorter must a array");
        }
        if( count( $arr) <=1 )
        {
            return $arr;
        }

        $length = \count( $arr);
        for( $i=0; $i<$length; $i++)
        {
            //$min = $arr[$i];
            for( $j=$i;$j<$length; $j++)
            {
                if( $arr[$i]> $arr[$j])
                {
                    $temp = $arr[$i];
                    $arr[$i] = $arr[$j];
                    $arr[$j] = $temp;
                    //打印输出
                    if( self::$is_debug )
                    {
                        echo 'step'.$i.'-'.$j.':';
                        $this->ArrayUtil->output( $arr, false);
                    }
                }
            }
        }
        return $arr;

    }

    /**
     * 合并排序（归并排序）
     * 归并（Merge）排序法是将两个（或两个以上）有序表合并成一个新的有序表，
     * 即把待排序序列分为若干个有序的子序列，再把有序的子序列合并为整体有序序列。
     * @param $arr : 修改了原来的数组。
     * @return mixed
     * @throws \Exception
     */
    function merge_sort( $arr )
    {
        //check input array;
        if( !\is_array( $arr ))
        {
            throw new \Exception( "Input Sorter must a array");
        }
        if( count( $arr) <=1 )
        {
            return $arr;
        }
        else
        {
            $this->merge_sort_divide( $arr, 0, (\count($arr)-1));
            return $arr;
        }
    }

    /**
     * 分冶函数， 递归将数组分解为只有两个元素的单元。
     * @param $arr
     * @param $start
     * @param $end
     * @return bool
     */
    function merge_sort_divide( &$arr, $start, $end )
    {
        if( $start >=$end )
        {
            return false;
        }
        else
        {
            $mid = floor( ($start+$end)/2);
            //mid是前半段数组的最后一个元素下标
            $this->merge_sort_divide($arr, $start, $mid);
            $this->merge_sort_divide($arr, $mid+1, $end);
            $this->merge_array_by_order( $arr, $start, $mid, $end);
            //调试输出
            if( self::$is_debug)
            {
                echo 'arr  :['.$start.'-'.$end.']   : ';
                $this->ArrayUtil->output( $arr, false);
            }
            return true;
        }
    }

    /**
     * 数组前后两部分是有序的，将他们按照顺序合并为一个数组
     * @param $arr
     * @param $start
     * @param $mid: 排序子数组A与排序子数组B的中间下标，也就是数组A的结束下标
     * @param $end
     * @return bool
     */

    function merge_array_by_order( &$arr, $start, $mid, $end)
    {
        if( $start>$mid || $mid > $end )
        {
            return false;
        }
        $length = $end - $start + 1;
        if( $length <= 1)
        {
            return true;
        }
        else
        {
            $merge_arr = array();
            $left = $start;
            $right = $mid+1;
            //从左右两堆中找最小的数。
            while( $left<=$mid and $right<=$end)
            {
                if( $arr[$left]<= $arr[$right])
                {
                    $merge_arr[]=$arr[$left];
                    $left++;
                }
                else
                {
                    $merge_arr[]=$arr[$right];
                    $right++;
                }
            }
            //前半段数据已经取完，将右半段剩下的数据直接接上
            if($left>$mid)
            {
                while( $right <= $end )
                {
                    $merge_arr[]=$arr[$right];
                    $right++;
                }

            }
            //右半段数据已经取完，将左半段剩下的数据直接接上
            if($right>$end)
            {
                while ($left <= $mid )
                {
                    $merge_arr[] = $arr[$left];
                    $left++;
                }
            }
            //将排列好的片段 修改回原来的数组
            for( $i=$start, $j=0; $i<=$end; $i++,$j++)
            {
                $arr[$i] = $merge_arr[$j];
            }

            if( self::$is_debug )
            {
                echo 'merge:['.$start.'-'.$end.']('.$mid.'): ';
                $this->ArrayUtil->output( $merge_arr, false);
            }
            return true;
        }

    }

    /**
     * 测试归并排序的合并过程
     */
    function test_merge_sort_submerge()
    {
        $test_arr = array(1,3,5,7,9,   2,4,6,8,10);
        $this->merge_array_by_order( $test_arr, 0, 4,9);
        $this->ArrayUtil->output($test_arr, false);

        $test_arr = array(1,3,5,7,   2,4,6,8,10);
        $this->merge_array_by_order( $test_arr, 0, 3,8);
        $this->ArrayUtil->output($test_arr, false);

    }

    /**
     * 快速排序（递归实现）
     * 1.在未排序序列中找到最小（大）元素，存放到排序序列的起始位置。
     * 2.再从剩余未排序元素中继续寻找最小（大）元素，然后放到已排序序列的末尾。
     * 3.以此类推，直到所有元素均排序完毕。
     * @param $arr
     * @return array
     * @throws \Exception
     */
    function quick_sort( $arr )
    {
        //check input array;
        if( !\is_array( $arr ))
        {
            throw new \Exception( "Input Sorter must a array");
        }
        if( count( $arr) <=1 )
        {
            return $arr;
        }

        $left = array();
        $right = array();
        $length = \count($arr);

        //取第一个数做关键数， 小于此数的放在左边，大于此数的放右边
        $key = $arr[0];
        for( $i=1; $i<$length; $i++)
        {
            if($arr[$i] <= $key )
            {
                $left[] = $arr[$i];
            }
            else
            {
                $right[] = $arr[$i];
            }
        }

        //递归分解
        $left = $this->quick_sort( $left );
        $right = $this->quick_sort( $right);

        //简单将三个数组拼接成一个。
        $arr = \array_merge( $left, array($key), $right);
        return $arr;
    }


    /**
     * 测试几种排序的正确性。
     * @param string $SortType： 常见的集中排序：bubble_sort，insert_sort，select_sort
     * @param $arr
     * @return null
     * @throws \Exception
     */
    function test( $SortType= 'BubbleSort', $arr )
    {
        echo"input raw array: ";
        $this->ArrayUtil->output( $arr, false );
        try
        {
            switch( trim($SortType) )
            {
                case 'bubble_sort':
                    $sorted_arr = $this->bubble_sort( $arr );
                    echo"after bubble sort:";
                    $this->ArrayUtil->output( $sorted_arr, false);
                    $this->check_sorted_array( $sorted_arr );
                    break;

                case 'insert_sort':
                    $sorted_arr = $this->insert_sort( $arr);
                    echo"after insert sort: ";
                    $this->ArrayUtil->output( $sorted_arr, false);
                    $this->check_sorted_array( $sorted_arr);
                    break;

                case 'select_sort':
                    $sorted_arr = $this->select_sort( $arr );
                    echo'after select sort: ';
                    $this->ArrayUtil->output( $sorted_arr, false );
                    $this->check_sorted_array( $sorted_arr );
                    break;

                case 'merge_sort':
                    $sorted_arr = $this->merge_sort( $arr);
                    echo'after merge sort: ';
                    $this->ArrayUtil->output( $sorted_arr, false );
                    $this->check_sorted_array( $sorted_arr );
                    break;

                case 'quick_sort':
                    $sorted_arr = $this->quick_sort($arr);
                    echo"after quick sort: ";
                    $this->ArrayUtil->output($sorted_arr, false);
                    $this->check_sorted_array( $sorted_arr );
                    break;

                default:
                    echo "Error: not found sort method, input test function is not correct\n";
                    return null;
            }


        }
        catch ( \Exception $e)
        {
            echo "Error: ".$e->getMessage();
        }
    }

    function check_sorted_array($sorted_arr)
    {
        if( $this->ArrayUtil->check_is_increasing_order($sorted_arr))
        {
            echo"Sort success!\n";
        }
        else
        {
            echo "Sort failed!\n";
        }
    }

}

$test_array = array( 7, 5, 6,2,3, 1, 4, 9, 8);
//$test_array = array( 5,2,4,6,1,3);
//$test_array = array( 2,1);
$Sorter = new Sorter();
$Sorter->set_debug( true );
//$Sorter->test( 'bubble_sort', $test_array);
//$Sorter->test( 'insert_sort', $test_array);
//$Sorter->test( 'select_sort', $test_array);
//有问题，还需要调试
//$Sorter->test_merge_sort_submerge();
$Sorter->test('merge_sort', $test_array);

//$Sorter->test('quick_sort', $test_array);
