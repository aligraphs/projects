<!DOCTYPE html>
<html>
<head>
<title>Seats</title>
</head>

<body>
<?php
    
    require ('connect.php');
    $conn = myconnect();
    session_start();
    echo "<h1>Canterbury Theatre</h1>";
    echo "Hello " . $_SESSION["username"] ."!";
    echo " Please select one or more seats and click 'Book'.</br></br>";
    $_SESSION["title"] = $title = $_GET['title'];
    $_SESSION["perfDate"] = $perfDate = $_GET['perfDate'];
    $_SESSION["perfTime"] = $perfTime = $_GET['perfTime'];
    $_SESSION["ticketPrice"] = $ticketPrice = $_GET['ticketPrice'];
    
    
    echo "<h3>Seats for " .$title." - ".$perfDate." - ".$perfTime. "</h3></br>";
    ?>

    <div id="checked">
    <p id="total">Total=</p>
    <p id="seats">Seats=</p>
    
  <?php
    $sql = "SELECT Seat.RowNumber, ROUND(Zone.PriceMultiplier * '".$_SESSION["ticketPrice"]."', 2) AS Price FROM Seat JOIN Zone ON Zone.Name=Seat.Zone WHERE Seat.RowNumber NOT IN (SELECT Booking.RowNumber FROM Booking WHERE Booking.PerfTime='.$perfTime.' AND Booking.PerfDate='.$perfDate.');";
        $handle = $conn->prepare($sql);
        $handle->execute();
        $conn = null;
        $res = $handle->fetchAll();
        //Create a table outside of the loop
        echo "<table>
        <tr>
        <th>Seat</th>
        <th>Price</th>
        <th></th>
        </tr>";
    
    foreach($res as $row) {
        echo "<tr>";
        //echo "<form action='['PHP_SELF']' method='GET'>";
        
        echo "<td>" .$row['RowNumber']. "</td>";
        $rowNu = $row['RowNumber'];
        echo "<td>" .$row['Price']. "</td>";
        $rowPr = $row['Price'];
       
        echo "<td><input type ='hidden' name='rowNumber' value='$rowNu'></td>";
        echo "<td><input type ='hidden' name='price' value='$price'></td>";
        echo "<td><input type='checkbox' onclick='calculation() name='$rowNu' value='$rowPr' ></td></tr>";
        //echo "</form>";
        
    }
    /*
    echo "<form name= 'submit' action='book.php' method='GET'>";
    echo "Total= " .$Total. "</br>";
    echo "Selected seats= </br>";
    echo "<input type='submit' value='Book'></br></br>";
    echo "</form>";
     */
    echo "</table>";
    ?>


<script type"text/javascript">

function calculation(){
    var tPrice = new Array[];
    var tRow = new Array[];
    
    var storeValues= document.querySelectAll('input[type=checkbox]:checked');
    total=0;
    for (var i=0; i<storeValues.length; i++){
        tPrice.push(storeValues[i].value);
        tRow.push(storeValues[i].name);
        
    }
    
    document.getElementById("checked").innerHTML="<h3>Selected seat: " + tRow +"</h3>" ;

    var price=0;
    for(var i in tPrice){
        price=parseInt(tPrice[i]);
        total= total+price;
        
    }
    document.getElementById("total").innerHTML = total;
    document.getElementById("seats").innerHTML = tRow;
    

}


</script>
</div>
</body>
