<?php 
class Database
{
    private $server_name = 'localhost';
    private $user_name = 'root';
    private $pass_word = '';
    private $data ='phanchiacongviec';
    private $conn = "";

    function __construct(){
        $this->ketnoi();
    } 

    function ketnoi(){
        $this->conn = mysqli_connect($this->server_name,$this->user_name,$this->pass_word,$this->data);
        return $this->conn;
    }
    function thucthi($sql){
       $result = mysqli_query($this->conn,$sql);
       return $result;
    }
}
?>