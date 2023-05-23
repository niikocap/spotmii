<?php
include "dollars.php";
session_start();
class database{
    private $conn;
    function set($sn,$un,$pw,$db){
        $this->conn = new PDO("mysql:host=$sn;dbname=$db", $un, $pw);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    function signin($credentials){
        $user = $credentials['user'];
        $password = $credentials['password'];
        $query = "SELECT * FROM users WHERE username = '$user' OR number = '$user' OR email = '$user'";
        $result = $this->conn->query($query);
        if ($result->rowCount() > 0) {
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                if($row['password']==$password){
                    return json_encode($row);
                }
            }
            return 1;
        }else {
            return 0;
        }
    }
    function signup($creds){
        $fname = $creds['fname'];
        $lname = $creds['lname'];
        $number = $creds['number'];
        $email = $creds['email'];
        $username = $creds['username'];
        $password = $creds['password'];
        $query = "INSERT INTO users (fname,lname,username,number,email,password,balance) VALUES ('$fname','$lname','$username','$number','$email','$password',0)";
        $this->conn->query($query);
        return $this->signin(array("user" => $username,"password" => $password));
    }
    function user($what){
        $query = "SELECT * FROM users WHERE $what";
        $result = $this->conn->query($query);
        $array = array();
        if ($result->rowCount() > 0) {
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                array_push($array,$row);
            }
            return $array;
        }
        return 0;
    }
    function sendMoney($credentials){
        
    }
    function check($creds){
        $what = $creds['what'];
        $target = $creds['target'];
        $query = "SELECT * FROM users where $what = '$target'";
        $result = $this->conn->query($query);
        if ($result->rowCount() > 0) {
            return false;
        }else{
            return true;
        }
    }
}
?>