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

if ( ! function_exists('debug')) {
    // this function set the value to form fields based on if it is new form or edit form.
    function debug($data) {
       echo "<pre>";
       print_r($data);
       die();
    }

}

if ( ! function_exists('formatDateForDb')) {
    // this function set the value to form fields based on if it is new form or edit form.
    function formatDateForDb($date) {
       return date("Y-m-d", strtotime($date));
    }

}

if ( ! function_exists('whereClauseExists')) {
    // this function set the value to form fields based on if it is new form or edit form.
    function whereClauseExists($query) {

        if (stripos($query, 'WHERE') !== false) {
            return true;
        }
        else{
            return false;
        }
    }

}