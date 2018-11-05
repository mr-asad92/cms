<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Permission {

    // init vars
    var $CI;                        // CI instance
    var $where = array();
    var $set = array();
    var $required = array();

    function __construct()
    {
        // init vars
        $this->CI =& get_instance();

        // set groupID from session (if set)
        $this->groupID = ($this->CI->session->userdata('groupID')) ? $this->CI->session->userdata('groupID') : 0;
    }

    // get permissions from for this group
    function get_user_permissions($groupID)
    {
        // grab keys Update
        /*
        $this->CI->db->select('key');
        $this->CI->db->join('permissions', 'permissions.permissionID = permission_map.permissionID');

        // get groups
        $this->CI->db->where('groupID', $groupID);
        */

        $this->CI->db->select('key');
        $this->CI->db->from('permissions');
        $this->CI->db->join('permission_map', 'permission_map.permissionID = permissions.permissionID');
        $this->CI->db->where('groupID', $groupID);
        // get groups
        $query = $this->CI->db->get();
        // set permissions array and return
        if ($query->num_rows())
        {
            foreach ($query->result_array() as $row)
            {
                $permissions[] = $row['key'];
            }

            return $permissions;
        }
        else
        {
            return false;
        }
    }

    // get all permissions, or permissions from a group for the purposes of listing them in a form
    function get_permissions($groupID = '')
    {
        // select
        $this->CI->db->select('DISTINCT(category)');

        // if groupID is set get on that groupID
        if ($groupID)
        {
            $this->CI->db->where_in('key', $this->get_user_permissions($groupID));
        }

        // order
        $this->CI->db->order_by('category');

        // return
        $query = $this->CI->db->get('permissions');

        if ($query->num_rows())
        {
            $result = $query->result_array();

            foreach($result as $row)
            {
                if ($cat_perms = $this->get_perms_from_cat($row['category']))
                {
                    $permissions[$row['category']] = $cat_perms;
                }
                else
                {
                    $permissions[$row['category']] = 'N/A';
                }
            }
            return $permissions;
        }
        else
        {
            return false;
        }
    }

    // get permissions from a category name, for the purposes of showing permissions inside a category
    function get_perms_from_cat($category = '')
    {
        // where
        if ($category)
        {
            $this->CI->db->where('category', $category);
        }

        // return
        $query = $this->CI->db->get('permissions');

        if ($query->num_rows())
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }

    // get the map of keys from a group ID
    function get_permission_map($groupID)
    {
        // grab keys
        $this->CI->db->select('permissionID');

        // where
        $this->CI->db->where('groupID', $groupID);

        // return
        $query = $this->CI->db->get('permission_map');

        if ($query->num_rows())
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }

    // get the groups, for the purposes of displaying them in a form
    function get_groups()
    {
        // where
        $this->CI->db->where('siteID', $this->siteID);

        // return
        $query = $this->CI->db->get('permission_groups');

        if ($query->num_rows())
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }

    // add permissions to a group, each permission must have an input name of "perm1", or "perm2" etc
    function add_permissions($groupID)
    {
        // delete all permissions on this groupID first
        $this->CI->db->where('groupID', $groupID);
        $this->CI->db->delete('permission_map');

        // get post
        $post = $this->CI->easysite->get_post();
        foreach ($post as $key => $value)
        {
            if (preg_match('/^perm([0-9]+)/i', $key, $matches))
            {
                $this->CI->db->set('groupID', $groupID);
                $this->CI->db->set('permissionID', $matches[1]);
                $this->CI->db->insert('permission_map');
            }
        }

        return true;
    }

    // a group to the permission groups table
    function add_group($groupName = '')
    {
        if ($groupName)
        {
            $this->CI->db->set('groupName', $groupName);
            $this->CI->db->insert('permission_groups');

            return $this->CI->db->insert_id();
        }
        else
        {
            return false;
        }
    }

}
