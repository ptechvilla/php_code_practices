<?php
require_once('function/function.php');
if(isset($_REQUEST['del_id'])){
    $delId=$_REQUEST['del_id'];
    //echo $delId;
    $sql="delete from customer_data where id=?";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$delId]);
    if($stmt){
        echo '<script>
         alert("record deleted successfully");
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
    <title>List Employee</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container mt-3">
        <div class="card">
            <h5 class="card-header text-center">List Employee</h5>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Position</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "select id,fname,lname,email,phone,position,gender created_on from customer_data where astatus='1' and deleted='0'";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        $cntrows = $stmt->rowCount();
                        $cnt = 1;
                        if ($cntrows) {
                            while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
                             //   echo '<pre>';
                               // print_r($data); die();
                        ?>
                                <tr>
                                    <td><?= $cnt++; ?></td>
                                    <td><?= $data['fname'] . " " . $data['lname']; ?></td>
                                    <td><?= $data['email']; ?></td>
                                    <td><?= $data['phone']; ?></td>
                                    <td><?= $data['position']; ?></td>

                                    <td>
                                        <i class="fa fa-eye" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight<?=$data['id'] ?>" aria-controls="offcanvasRight"></i>&nbsp;/&nbsp;
                                        <a href="?del_id=<?=$data['id'] ?>"><i class="fa fa-trash"></i></a>&nbsp;/&nbsp;
                                        <a href="edit-employee.php?id=<?=$data['id'] ?>"><i class="fa fa-edit"></i></a>
 
                                    </td>
                                </tr>

                        <?php
                            }
                        }

                        ?>


                    </tbody>

                </table>

            </div>
<!-- start -->
<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Toggle right offcanvas</button>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 id="offcanvasRightLabel">Offcanvas right</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    ...
  </div>
</div>
<!-- End -->
        </div>

    </div>

    
    </div>

  


    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>
</body>

</html>