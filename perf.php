<?php
    session_start();
?>
    
<!DOCTYPE html>
<html>
<head>
<title>Performance</title>
</head>

<body>
<?php
   
    require('connect.php');
    $conn = myconnect();
     
    echo "<h1>Canterbury Theatre</h1>";
    $name=$_GET['name'];
    $email=$_GET['email'];
    echo "Welcome ".$name. ". Please select a performance.</br></br>";
    $_SESSION["username"]=$name;
    $_SESSION["mail"]=$email;
    $sql = "SELECT * FROM Performance p JOIN Production r ON p.Title=r.Title;";
	$handle = $conn->prepare($sql);
	$handle->execute();
	$conn = null;
	$res = $handle->fetchAll();
	//Create a table outside of the loop
    echo "<table>
     <tr>
     <th>Title</th>
     <th>Date</th>
     <th>Time</th>
     </tr>";
    
        foreach($res as $row) {
         
        echo "<tr>
            <form action='seats.php' method='GET'>";
            
        echo "<td>" .$title=$row['Title']. "</td>";
        echo "<td>" .$perfDate=$row['PerfDate']. "</td>";
        echo "<td>" .$perfTime=$row['PerfTime']. "</td>";
        
            $ticketPrice=$row['BasicTicketPrice'];
            
        echo "<td><input type ='hidden' name='title' value='$title'></td>";
        echo "<td><input type ='hidden' name='perfDate' value='$perfDate'></td>";
        echo "<td><input type ='hidden' name='perfTime' value='$perfTime'></td>";
        echo "<input type = 'hidden' name='ticketPrice' value='$ticketPrice'>";
            
        echo "<td><input type='submit' value='Show availability'></td></tr>";

        echo "</form>";
	}
    echo "</table>";
    ?>




</body>

