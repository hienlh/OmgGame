<?php

namespace OmgGame\Models;

class InfoFormType
{
    public static $radio = 'RADIO';
    public static $selection = 'SELECTION';
    public static $datePicker = 'DATE_PICKER';
    public static $textInput = 'TEXT_INPUT';

    /**
     * @param $str string
     * @return bool
     */
    public static function isInfoFormType($str)
    {
        return $str == InfoFormType::$radio || $str == InfoFormType::$datePicker || $str == InfoFormType::$selection || $str == InfoFormType::$textInput;
    }

    /**
     * @return array
     */
    public static function getAll()
    {
        return [InfoFormType::$radio,
            InfoFormType::$selection,
            InfoFormType::$datePicker,
            InfoFormType::$textInput];
    }
}
