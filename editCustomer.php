
<!DOCTYPE html>
<html lang="en">
<?php
	include "session_check.php";
?>
<head>
    <title>Edit Customer Profile</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/cust_style.css">
    <link rel="stylesheet" type="text/css" href="css/nav_style.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <?php
    $custID = $_GET['target'];
    $result = mysqli_query($connect, "SELECT * FROM customer WHERE customerID ='".$custID."'");
    //$row = mysqli_fetch_array($sql,MYSQLI_ASSOC);
    
    if($result){
        while($row = mysqli_fetch_array($result)){
            $custName = $row['customerName'];
            $custDob = $row['customerDoB'];
            $custGender = $row['customerGender'];
            $custType = $row['customerType'];
            $custPhone = $row['customerPhone'];
            $custInfo = $row['customerAddInfo'];
        }
    }
    
    
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="sideNav">
                    <?php
                        include "navigation.php";
                    ?>
                </div>
            </div>

            <div class="col-md-10">
                <h1>Edit Customer Profile</h1>
                <br />
                <form method="post" action="addCustProcess.php?action=update&custID=<?php echo $custID; ?>" onsubmit="return custValidate()">
                    <div class="form-group">
                        <label for="custFullname">Full Name</label>
                        <p><input type="text" placeholder="Full Name" id="custFullname" class="form-control" name="custFullname" value="<?php echo $custName;?>"/></p>
                        <p id="nameErrorMsg"></p>
                    </div>

                    <div class="form-group">
                        <label for="custDob">Date of Birth</label><br />
                        <input type="date" id="custDob" class="form-control" name="custDob" value="<?php echo $custDob;?>"/>
                        <p id="dobErrorMsg"></p>
                    </div>

                    <div class="form-group">
                        <label>Gender</label><br />
                        <input type="radio" name="custGender" id="genderF" value="Female" <?php echo ($custGender == 'F') ? 'checked' : '' ?>> Female
                        <input type="radio" name="custGender" id="genderM" value="Male"  <?php echo ($custGender == 'M') ? 'checked' : '' ?>> Male
                        <p id="genderErrorMsg"></p>
                    </div>

                    <div class="form-group">
                        <label for="custType">Type</label><br />
                        <select id="custType" class="form-control" name="custType">
                            <option value="Regular" <?php echo ($custType == 'Regular') ? 'selected = \'selected\' ' : '' ?>>Regular</option>
                            <option value="Guest" <?php echo ($custType == 'Guest') ? 'selected = \'selected\' ' : '' ?>>Guest</option>
                        </select>
                        <p id="typeErrorMsg"></p>
                    </div>

                    <div class="form-group">
                        <label for="custPhoneNum">Phone Number</label><br />
                        <input type="tel" class="form-control" id="custPhoneNum" name="custPhoneNum" value="<?php echo $custPhone; ?>"/>
                        <p id="phoneErrorMsg"></p>
                    </div>

                    <div class="form-group">
                        <label for="custInfo">Additional Information</label><br />
                        <textarea name="custInfo" class="form-control" id="custInfo" cols="47" rows="5"><?php echo $custInfo; ?></textarea>
                    </div>


                    <div class="form-group text-center">
                        <p><input type="button" class="btn btn-default" value="Cancel" onclick="window.location.replace('displayCustomer.php')">
                            <input type="submit" class="btn btn-primary" value="Submit" name="submit"></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        function custValidate() {
            var isAllOK = true;
            var fullname = document.getElementById("custFullname").value;
            var dob = document.getElementById("custDob").value;
            var genderF = document.getElementById("genderF");
            var genderM = document.getElementById("genderM");
            var type = document.getElementById("custType").value;
            var phoneNum = document.getElementById("custPhoneNum").value;

            var nameErrorMsg = document.getElementById('nameErrorMsg');
            var dobErrorMsg = document.getElementById('dobErrorMsg');
            var genderErrorMsg = document.getElementById('genderErrorMsg');
            var typeErrorMsg = document.getElementById('typeErrorMsg');
            var phoneErrorMsg = document.getElementById('phoneErrorMsg');

            
                if (fullname == "") {
                    nameErrorMsg.innerHTML = "Fullname cannot be empty";
                    isAllOK = false;
                }else{
                    nameErrorMsg.innerHTML = "";
                }

                if (dob == "") {
                    dobErrorMsg.innerHTML = "Date of birth cannot be empty";
                    isAllOK = false;
                }else{
                    dobErrorMsg.innerHTML = "";
                }

                if (!genderF.checked && !genderM.checked) {
                    genderErrorMsg.innerHTML = "Please select gender";
                    isAllOK = false;
                }else{
                    genderErrorMsg.innerHTML = "";
                }

                if (type == "") {
                    typeErrorMsg.innerHTML = "Please select type";
                    isAllOK = false;
                }else{
                    typeErrorMsg.innerHTML = "";
                }

                if (phoneNum == "") {
                    phoneErrorMsg.innerHTML = "Please enter phone number";
                    isAllOK = false;
                }else{
                    if (phoneNum.length > 10 || phoneNum.length < 8) {
                        phoneErrorMsg.innerHTML = "Invalid phone number format";
                        isAllOK = false;
                    }else{
                        phoneErrorMsg.innerHTML = "";
                    }
                }
            
            if(isAllOK === true){
                confirm('Confirm edit?');
            }
            
            return isAllOK;
            
        }
        

    </script>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
