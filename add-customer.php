<?php
$skill_str = "";
$valid_ext=array("jpg","jpeg","pnp","gif");
$valid_size=2*1024*1024;
require_once('function/function.php');
if (isset($_POST['btn'])) {
    extract($_POST);
    $skill_str = implode(",", $skills);
    //echo $skill_str;
    // echo '<pre>';
    // print_r($_POST);
    // die();
    $password = $_POST['pass1'];
   $pass1 = password_hash($password, PASSWORD_BCRYPT);

    if(isset($_FILES['img']['name'])) {
        $fileName = $_FILES['img']['name'];
        $fileSize=$_FILES['img']['size'];
        $fileExt=pathinfo($fileName,PATHINFO_EXTENSION);
        $path="images/".$fileName;
       if(!in_array($fileExt,$valid_ext)){
        die("invalid file");
       }
       if($fileSize>$valid_size){
        die("not allowed file size is greater than 2*1024*1024");
       }else{
        if(!move_uploaded_file($_FILES['img']['tmp_name'],$path)) {
            die("Error in file upload");
        }
       }
        
    }




    // insert into database
    $sql = "INSERT INTO customer_data(fname,lname,email,pass,phone,position,education,dob,doj,skills,gender,marital_status,pic) values (?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$fname, $lname, $email, $pass1, $phone, $position, $education, $dob, $doj, $skill_str, $gender, $marital_status,$fileName]);
    if (!$stmt="") {
        echo '<script>
        alert("data inserted successfully");
        </script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add-customer</title>

</head>

<body>
    <div class="container">
        <div class="card">
            <h5 class="card-header text-center">Add-customer 
                <a href="list-employee.php"><button class="btn btn-sm btn-primary rounded-pill">View</button></a>
            </h5>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="row mt-3">
                        <div class="col">
                            <label>First Name: </label>
                            <input type="text" name="fname" class="form-control" placeholder="Enter First Name">
                        </div>
                        <div class="col">
                            <label>Last Name: </label>
                            <input type="text" name="lname" class="form-control" placeholder="Enter Last Name">
                        </div>
                    </div><br>


                    <div class="row mt-3">
                        <div class="col">
                            <label>Email: </label>
                            <input type="email" name="email" class="form-control" placeholder="Enter email">
                        </div>
                        <div class="col">
                            <label for="">Password: </label>
                            <input type="password" name="pass1" placeholder="Enter Password" class="form-control">
                        </div>
                    </div><br>

                    <div class="row mt-3">
                        <div class="col">
                            <label>Phone: </label>
                            <input type="text" name="phone" class="form-control" maxlength="10" minlength="10" placeholder="Enter phone number">
                        </div>
                        <div class="col">
                            <label for="">picture: </label>
                            <input type="file" name="img" class="form-control">
                        </div>

                    </div>


                    <div class="row mt-3">
                        <div class="col">
                            <label>Position: </label>
                            <select name="position" class="form-control">
                                <option value="">--Please select--</option>
                                <option value="Fresher">Fresher</option>
                                <option value="Team leader">Team Leader</option>
                                <option value="Junior developer">Junior Developer</option>
                                <option value="senior developer">Senior Developer</option>
                            </select>
                        </div>
                        <div class="col">
                            <label>Highest Education: </label>
                            <select name="education" class="form-control">
                                <option value="">--Please select--</option>
                                <option value="MCA">MCA</option>
                                <option value="BTECH">BTECH</option>
                                <option value="BCA">BCA</option>
                                <option value="BBA">BBA</option>
                                <option value="MBA">MBA</option>
                                <option value="BSC">BSC</option>
                            </select>
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col">
                            <label>DOB: </label>
                            <input type="date" name="dob" class="form-control" placeholder="Enter your DOB">
                        </div>
                        <div class="col">
                            <label>DOJ: </label>
                            <input type="date" name="doj" class="form-control" placeholder="Enter your DOJ">
                        </div>
                    </div><br>


                    <div class="row mt-3">
                        <div class="col">
                            <label name="skills" class="form-label">Skills: </label>
                            <input type="checkbox" value="java" name="skills[]">JAVA &nbsp;
                            <input type="checkbox" value="html" name="skills[]">HTML &nbsp;
                            <input type="checkbox" value="css" name="skills[]">CSS &nbsp;
                            <input type="checkbox" value="java script" name="skills[]">Java Script &nbsp;
                            <input type="checkbox" value="angular" name="skills[]">Angular &nbsp;
                            <input type="checkbox" value="PHP" name="skills[]">PHP
                        </div>
                        <div class="col">
                            <label> Gender:</label>
                            <input type="radio" name="gender" value="M">MALE &nbsp;
                            <input type="radio" name="gender" value="F">FEMALE &nbsp;
                            <input type="radio" name="gender" value="T">OTHER
                        </div>
                    </div><br>


                    <div class="row mt-3">
                        <div class="col">
                            <label> Marital Status:</label>
                            <input type="radio" name="marital_status" value="Y">YES &nbsp;
                            <input type="radio" name="marital_status" value="N">NO
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary rounded-pill" name="btn">Submit</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    </div>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</body>

</html>