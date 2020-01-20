<?php
    session_start();
    include 'connect.php';
    echo "<h1>Canterbury Theatre</h1>";
    echo "Hello " .$_SESSION["username"]. ", thank you for your purchase.</br>";
    echo "Booking summary for</br>";
    
    echo "<h3>" .$_SESSION["title"]. " - " .$_SESSION["perfDate"]. " - " .$_SESSION["perfTime"]. "<h3/>";
?>
