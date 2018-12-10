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


if ( ! function_exists('formatDateForView')) {
    // this function set the value to form fields based on if it is new form or edit form.
    function formatDateForView($date, $format = "d-m-Y") {
       return date($format, strtotime($date));
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

if ( ! function_exists('trialBalanceListing')) {
    function trialBalanceListing($tree_structure, $rows, $level = 0, $trial_balance = []) {


        $space_limit = $level * 5;
        $spaces = '';

        for($i = 0; $i<$space_limit; $i++){
            $spaces .= "&nbsp;";
        }

        if (is_array($tree_structure) && count($tree_structure)) {

            foreach ($tree_structure as $key => $leaf) {

                $trial_balance[] =  [
                    'account_id' => $leaf['id'],
                    'account_name' => $spaces.$leaf['account_name'],
                    'debit_amount' => $rows[$leaf['id']]['debit_amount'],
                    'credit_amount' => $rows[$leaf['id']]['credit_amount']
                ];

                if (isset($leaf["descendants"])) {
                    $level++;
                    $trial_balance[] = trialBalanceListing($leaf["descendants"], $rows,  $level);
                }

            }

        }

        return $trial_balance;
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
                $html .= "<tr ".$active." id='".$leaf['id']."'>\n";

                $account_type = ($leaf['account_type'] ==  1)?"Debit":"Credit";
                $html .= "
<td >".$leaf['id']."</td>
<td ><span style='padding-left: $pad;'>".$leaf['account_name']."</span></td>
<td >".$account_type."</td>
<td >".$leaf['created_at']."</td>
<td >".$leaf['description']."</td>
<td > <a href=\"".base_url()."accounts/update_account/".$leaf['id']."\">Edit </a></td>
</tr>\n";
//                | <a href=\"javascript:deleteAccount('".$leaf['id']."')\">Delete</a>
                if (isset($leaf["descendants"])) {
                    $level++;
                    $html .= getChildren($leaf["descendants"],  $level);
                }

            }
        }
        return $html;
    }

}

if ( ! function_exists('getHieraricalAccounts')) {
    // this function set the value to form fields based on if it is new form or edit form.
    function getHieraricalAccounts($tree_structure, $level = 0, $parent_id = null) {

        $html = "";

        $space_limit = $level * 3;
        $spaces = '';

        for($i = 0; $i<$space_limit; $i++){
            $spaces .= "&nbsp;";
        }

        $heirarchy_indicator = 'l_';
        if (is_array($tree_structure) && count($tree_structure)) {

            foreach ($tree_structure as $key => $leaf) {
                $active = "";
                if($leaf['parent_id'] == 0){
                    $active = "style='background-color:#f2f2f2;'";
                    $heirarchy_indicator = '';
                }
                $selected = "";
                if($leaf['id'] == $parent_id){
                    $selected = "selected = 'selected'";
//                    $selected = $leaf['parent_id'];
                }
                $html .= "<option ".$active." value='".$leaf['id']."' ".$selected.">\n";

                $html .= $spaces.$heirarchy_indicator.$leaf['account_name']."</option>\n";
                if (isset($leaf["descendants"])) {
                    $level++;
                    $html .= getHieraricalAccounts($leaf["descendants"],  $level, $parent_id);
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


if ( ! function_exists('postCURL')) {
    // this function set the value to form fields based on if it is new form or edit form.
     function postCURL($_url, $_param){

        $postData = '';
        //create name value pairs seperated by &
        foreach($_param as $k => $v)
        {
            $postData .= $k . '='.$v.'&';
        }
        rtrim($postData, '&');


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, count($postData));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

        $output=curl_exec($ch);

        curl_close($ch);

        return $output;
    }

}

if ( ! function_exists('check_permissions')) {
    // this function set the value to form fields based on if it is new form or edit form.
    function check_permissions() {



    }

}

if ( ! function_exists('number_shorten')) {
    // this function set the value to form fields based on if it is new form or edit form.
    function number_shorten($number, $precision = 2, $divisors = null) {

        // Setup default $divisors if not provided
        if (!isset($divisors)) {
            $divisors = array(
                pow(1000, 0) => '', // 1000^0 == 1
                pow(1000, 1) => 'K', // Thousand
                pow(1000, 2) => 'M', // Million
                pow(1000, 3) => 'B', // Billion
                pow(1000, 4) => 'T', // Trillion
                pow(1000, 5) => 'Qa', // Quadrillion
                pow(1000, 6) => 'Qi', // Quintillion
            );
        }

        // Loop through each $divisor and find the
        // lowest amount that matches
        foreach ($divisors as $divisor => $shorthand) {
            if (abs($number) < ($divisor * 1000)) {
                // We found a match!
                break;
            }
        }

        // We found our match, or there were no matches.
        // Either way, use the last defined value for $divisor.
        return number_format($number / $divisor, $precision) . $shorthand;
    }

}