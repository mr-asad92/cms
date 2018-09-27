<?php
/**
 * Created by PhpStorm.
 * User: Hafiz Ali Hamza
 * Date: 9/22/2018
 * Time: 12:06 PM
 */

class Accounts_model extends CI_Model
{
    public function getAccounts()
    {
        $q = $this->db->get('accounts');
        return $q->result();
    }

}