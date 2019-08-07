<?php


class Query extends CI_Model{

    function GetAllData($table){
        return $this -> db -> get($table);
    }

    function inputData($data,$table){

        return $this -> db -> insert($table,$data);

    }
    function delData($table){

        $delete = $this -> db -> empty_table($table);
        return $delete;
    }
}