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

if ( ! function_exists('buildTree')) {
    function buildTree($flat, $pidKey, $idKey = null)
    {
        $grouped = array();
        foreach ($flat as $sub){
            $grouped[$sub[$pidKey]][] = $sub;
        }

        $fnBuilder = function($siblings) use (&$fnBuilder, $grouped, $idKey) {
            foreach ($siblings as $k => $sibling) {
                $id = $sibling[$idKey];
                if(isset($grouped[$id])) {
                    $sibling['descendants'] = $fnBuilder($grouped[$id]);
                }
                $siblings[$k] = $sibling;
            }

            return $siblings;
        };

        $tree = $fnBuilder($grouped[0]);

        return $tree;
    }

}

if ( ! function_exists('getChildren')) {
    function getChildren($tree_structure, $level = 0) {
        $html = "";

        $pad = $level * 10;
        $pad .= 'px';
        if (is_array($tree_structure) && count($tree_structure)) {

            foreach ($tree_structure as $key => $leaf) {
                $active = "";
                if($leaf['parent_id'] == 0){
                    $active = "style='background-color:#f2f2f2;'";
                }
                $html .= "<tr ".$active.">\n";

                $account_type = ($leaf['account_type'] ==  1)?"Debit":"Credit";
                $html .= "
<td >".$leaf['id']."</td>
<td ><span style='padding-left: $pad;'>".$leaf['account_name']."</span></td>
<td >".$account_type."</td>
<td >".$leaf['created_at']."</td>
<td >".$leaf['description']."</td>
<td >edit | delete</td>
</tr>\n";
                if (isset($leaf["descendants"])) {
                    $level++;
                    $html .= getChildren($leaf["descendants"],  $level);
                }

            }
        }
        return $html;
    }

}

if ( ! function_exists('getDaysDifference')) {
    function getDaysDifference($dateOne, $dateTwo){

        $diff = abs(strtotime($dateTwo) - strtotime($dateOne));

        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

        return $days;
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