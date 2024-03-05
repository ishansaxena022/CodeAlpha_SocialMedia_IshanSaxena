<?php
 session_start();
 session_destroy();
 echo 'logout';
 header('location:index.php');

 ?>