<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('setVal')) {
    // this function set the value to form fields based on if it is new form or edit form.
    function setVal($data, $defaultVal = '', $edit_val = '',  $isEdit = false) {
        if ($isEdit){
            return $data[$edit_val];
        }
        return $defaultVal;
    }

}