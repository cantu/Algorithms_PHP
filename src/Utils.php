<?php
/**
 * Created by PhpStorm.
 * User: tusion
 * Date: 15-3-26
 * Time: 上午10:23
 */

namespace tusion\algorithms;


class Utils {
    public $start_memory;   //起始PHP占用内存
    public $end_memory;     //结束PHP占用内存
    public $memory_cost;    //实际占用内存
    public $memory_peak;    //内存最高占用;

    public $start_ms;       //开始时间
    public $end_ms;         //结束时间
    public $time_cost;    //运行时间

    function __construct()
    {
        $this->clear_all();
    }

    function __descotruct()
    {
        ;
    }

    /**
     * 清空所有计数器
     * @return bool
     */
    function clear_all()
    {
        $this->start_memory = 0;
        $this->end_memory = 0;
        $this->memory_cost = 0;
        $this->start_ms = 0;
        $this->end_ms = 0;
        $this->time_cost =0;
        return true;
    }

    function probe_start()
    {
        $this->start_memory = \memory_get_usage( true);
        $this->start_ms = \microtime();
    }

    function probe_end()
    {
        $this->end_memory = \memory_get_usage( true );
        $this->end_ms = \microtime();
        $this->time_cost = $this->end_ms - $this->start_ms;
        $this->memory_cost = $this->end_memory - $this->start_memory;
        $this->memory_peak = memory_get_peak_usage( true);
    }

    function probe_result()
    {
        echo"----- probe result: ------\n";
        echo"[Memory cost]: ".\round( ($this->memory_cost/1024), 3)." kB \n";
        echo"[Memory peak]: ".\round( ($this->memory_peak/1024), 3)." kB \n";
        echo"[Time   cost]: ".$this->time_cost." ms \n";
    }

}