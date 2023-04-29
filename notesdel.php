<?php
include "./notesdb.php";
$id=$_GET["id"];
$deleteQuery="DELETE FROM `notes` WHERE Note_ID='$id'";
$result=mysqli_query($conn,$deleteQuery);
header("location:./notes.php");
?>