<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHPCRUD</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
    <?php include_once 'process.php';  ?>

   
    <?php 
    if(isset($_SESSION['message'])) {?>
    <div class="alert alert-<?=$_SESSION['msg_type']?>">
   
      
    <?php echo $_SESSION['message'];
           unset($_SESSION['message'])
    ?>
     
    </div>
    <?php }?>
    
    



    <div class="container">
    <?php 
    $mysqli = new mysqli('localhost','root','','crud') or die(mysqli_error($mysqli));
    $result = $mysqli->query("select * from data") or die(mysqli_error($mysqli));
  // pre_r($result);
    // pre_r($result->fetch_assoc());
    // function pre_r($array){
    //     echo '<pre>';
    //     print_r($array);
    //     echo '</pre>';
    // }
    
    ?>



    <div class="row justify-content-center">
        <table class="table">
            <thead>
                <tr>
                    
                    <th>Name</th>
                    <th>Location</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <?php 
                while($row = $result->fetch_assoc()){ ?>

                <tr>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['location'];?></td>

                    <td>
                        <a href="index.php?edit=<?php echo $row['id'];?>" class="btn btn-info">Edit</a>
                        <a href="index.php?delete=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php }?>
            
        </table>
    </div>




    

   
    <div class="row justify-content-center">
        <form action="process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <div class="form-group">
                <label >Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name;?>" placeholder="enter your name">
            </div>
            <div class="form-group">
                <label >Location</label>
                <input type="text" name="location"   class="form-control" value="<?php echo $location;?>" placeholder="enter your location">
            </div>
                <div class="form-group">
                <?php if($update == true){ ?>
                    <button type="submit" class="btn btn-info" name="update">Update</button>
                 <?php }else {?>
                     <button type="submit" class="btn btn-primary" name="save">Save</button>
                <?php }?>
            </div>
        </form>
    </div>
    </div>
</body>
</html>