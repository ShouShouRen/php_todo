<?php
session_start();
// session_destroy();  
extract($_GET);
unset($_SESSION["AUTH"]);
header("Location:index.php");
