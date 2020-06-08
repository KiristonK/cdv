<?php
require_once "connection.php";
if (isset($_POST['add'])){
    //post to db
    $sql = "insert into `events`(`name`,`text`) values ?,?";

}else if(isset($_POST['edit'])){
    $sql = "select * from `events` where id = ?";
}