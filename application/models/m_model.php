<?php

class m_model extends CI_model{
    function get_data($table){
        return $this->db->get($table);                                                                                   
    }
}

?>