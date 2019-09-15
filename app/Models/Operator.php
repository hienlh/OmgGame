<?php

namespace OmgGame\Models;

use DateTime;

class Operator
{
    public static $equal = '=';
    public static $more = '>';
    public static $moreEqual = '>=';
    public static $less = '<';
    public static $lessEqual = '<=';
    public static $difference = '!=';

    /**
     * @param $str string
     * @return bool
     */
    public static function isOperator($str)
    {
        foreach (self::getAll() as $item) {
            if ($str == $item) return true;
        }
        return false;
    }

    /**
     * @return array
     */
    public static function getAll()
    {
        return [Operator::$equal,
            Operator::$more,
            Operator::$moreEqual,
            Operator::$less,
            Operator::$lessEqual,
            Operator::$difference,];
    }

    /**
     * @param $left_value string|DateTime|int|float
     * @param $right_value string|DateTime|int|float
     * @param $operator
     * @return bool
     */
    public static function handle($left_value, $right_value, $operator) {
        switch ($operator) {
            case Operator::$equal: return $left_value == $right_value;
            case Operator::$more: return $left_value > $right_value;
            case Operator::$moreEqual: return $left_value >= $right_value;
            case Operator::$less: return $left_value < $right_value;
            case Operator::$lessEqual: return $left_value <= $right_value;
            case Operator::$difference: return $left_value != $right_value;
            default: return false;
        }
    }
}
