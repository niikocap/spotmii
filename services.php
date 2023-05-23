<?php
include "dollars.php";
include "database.php";
$database = new database();
$database->set($sn,$un,$pw,$db);
password_hash("password",PASSWORD_BCRYPT,array('cost' => 12));
//echo password_verify('password','$2y$12$98s6KyWu.VB.w2C2wpoiEut14GDTYAjyoKxgDGtwubz9blBWI/NUG');
//echo json_encode($_POST["test"]);
if($_POST['req'] == "signIn"){
    echo $database->signin($_POST);
}else if($_POST['req'] == "signUp"){
    echo $database->signup($_POST);
}else if($_POST['req'] == "check"){
    echo json_encode($database->check($_POST));
}
?>