<?php

class Crud_model extends CI_Model
{

    // Note : getTableDataWithOrWithoutCondArray method is use for multile table with or without condition in array
    function getTableDataWithOrWithoutCondArray($tableName = "", $cond = "")
    {
        if ($cond) {
            $result = $this->db->select('*')->get_where($tableName, $cond)->result();
        } else {
            $result = $this->db->select('*')->get($tableName)->result();
        }
        return $result;
    }
    function getTableDataWithOrWithoutCondArrayOrderby($tableName = "", $cond = "", $orderby = "", $order = "")
    {
        if ($cond) {
            $result = $this->db->select('*')->order_by($orderby, $order)->get_where($tableName, $cond)->result();
        } else {
            $result = $this->db->select('*')->order_by($orderby, $order)->get($tableName)->result();
        }
        return $result;
    }
    // Note : getTableDataWithOrWithoutCondArrayByID method is use for multile table with or without condition in array and ID
    function getTableDataWithOrWithoutCondArrayByID($tableName = "", $id = "", $cond = "")
    {
        if ($cond) {
            $result = $this->db->select('*')->where($tableName . '_id', $id)->get_where($tableName, $cond)->result();
        } else {
            $result = $this->db->select('*')->where($tableName . '_id', $id)->get($tableName)->result();
        }
        return $result;
    }

    function insert_dataIntoTable($table, $record)
    {
        $this->db->insert($table, $record);
        return $this->db->insert_id();
    }
     function delete_dataIntoTable($table, $cond)
    {
        return $this->db->where($cond)->delete($table);
    }
    function deleteDataWishList($user_id = "", $property_id = "")
    {
        return $this->db->where('user_id', $user_id)->where('property_id', $property_id)->delete('wishlist');
    }
    function getMaxMinValue($table = "", $field = "")
    {
        $query = "SELECT MAX($field) as maxval , MIN($field) as minval FROM $table WHERE status=1";
        $result = $this->db->query($query);

        return $result->result();
    }
    function updateData($table="",$id=[],$data=[])
    {        
        return $this->db->update($table,$id,$data);
        // echo $this->db->last_query(); exit;
    }
    

}
