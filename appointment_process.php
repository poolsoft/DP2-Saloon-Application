<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
</head>



<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $pw = "";
    $db = "saloon";
    $conn = mysqli_connect($servername, $username, $pw, $db);
    if (!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }
    if (isset($_POST["appID"])){
        $appointmentID = $_POST["appID"];
    }
    $cID = $_POST["cID"];
    $cName = $_POST["cName"];
    $cPhone = $_POST["cPhone"];
    $cSv = $_POST["cSv"];
    $cDate = $_POST["cDate"];
    $cTime = $_POST["cTime"];
    $cNotes = $_POST["cNotes"];
    $cButton = $_POST["cButton"];
    if (!$cID){
        $select = "SELECT customerID from customer ORDER BY customerID DESC LIMIT 1";
        $result = mysqli_query($conn,$select);
        $row = mysqli_fetch_array($result);
        $cID = $row['customerID'];
        $cID = $cID+1;
        $createCustomer = "INSERT INTO customer(customerID,customerType,customerName,customerPhone,customerDoB) VALUES('$cID','Guest','$cName','$cPhone','1999-03-13')";
        mysqli_query($conn,$createCustomer);
    }
    if ($cButton == "Submit"){
    $sql = "INSERT INTO appointment(customerID,customerName,customerPhone,appointmentService,appointmentDate,appointmentTime,appointmentNotes) VALUES('$cID','$cName','$cPhone','$cSv','$cDate','$cTime','$cNotes')";
    
    if (mysqli_query($conn,$sql)){
        echo '<script type="text/javascript">alert("Successfully Submitting Enquiry");</script>';
	}
	else{
		echo '<script type="text/javascript">alert("Fail to Submit Enquiry");</script>';
	}
    }else if ($cButton == "Edit"){
        $update = 	"UPDATE appointment SET customerID='$cID' WHERE appointmentID='$appointmentID'";
        $update1 = 	"UPDATE appointment SET customerName='$cName' WHERE appointmentID='$appointmentID'";
        $update2 = 	"UPDATE appointment SET customerPhone='$cPhone' WHERE appointmentID='$appointmentID'";
        $update3 = 	"UPDATE appointment SET appointmentService='$cSv' WHERE appointmentID='$appointmentID'";
        $update4 = 	"UPDATE appointment SET appointmentDate='$cDate' WHERE appointmentID='$appointmentID'";
        $update5 = 	"UPDATE appointment SET appointmentTime='$cTime' WHERE appointmentID='$appointmentID'";
        $update6 = 	"UPDATE appointment SET appointmentNotes='$cNotes' WHERE appointmentID='$appointmentID'";
        if (mysqli_query($conn,$update)&&mysqli_query($conn,$update2)&&mysqli_query($conn,$update1)&&mysqli_query($conn,$update3)&&mysqli_query($conn,$update4)&&mysqli_query($conn,$update5)&&mysqli_query($conn,$update6)){
		  echo '<script type="text/javascript">alert("Successfully Updated");</script>';
	   }
	   else{
		  echo '<script type="text/javascript">alert("Failed to edit");</script>';
	   }
    }
    
    echo $cPhone;
?>
  <p><?php echo $cID?></p>
   <p><?php echo mysqli_error($conn)?></p>
    

</body>

</html>
