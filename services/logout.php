<?php
session_start();
unset($_SESSION['user']->name);
unset($_SESSION['user']->image);

header( 'Location: /' ) ; 
?>
