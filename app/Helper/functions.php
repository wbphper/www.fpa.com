<?php

/**
 * 系统全局自定义助手函数
 * @author WangBen
 */

/**
 * ObjectToArray
 * @author wangben
 */
if (!function_exists('o2a')) {
    function o2a($d)
    {
        if (is_object($d)) {
            if (method_exists($d, 'getArrayCopy')) {
                $d = $d->getArrayCopy();
            } elseif (method_exists($d, 'getArrayIterator')) {
                $d = $d->getArrayIterator()->getArrayCopy();
            } elseif (method_exists($d, 'toArray')) {
                $d = $d->toArray();
            } else {
                $d = get_object_vars($d);
            }
        }
        if (is_array($d)) {
            return array_map(__FUNCTION__, $d);
        }
        return $d;
    }
}

/**
 * 获取分表后缀
 * @author wangben
 */
if (!function_exists('get_tb_num')) {
    function get_tb_num($value, $tbNum = 10)
    {
        if (!$value || is_object($value)) {
            return 0;
        }
        if (is_numeric($value)) {
            $num = intval(substr($value, -2));
        } else if (is_string($value)) {
            $num = sprintf("%u", crc32($value));
        }
        return $num % $tbNum;
    }
}