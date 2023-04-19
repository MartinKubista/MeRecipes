<?php
require_once('../scripts/connection.php');

$sql = "SELECT * FROM users";
$result = $conn->query($sql);
$users = [];

while($user = $result->fetch_assoc()){
    array_push($users, $user);
}
?>