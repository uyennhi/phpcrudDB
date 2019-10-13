<?php 
    session_start();
    $mysqli = new mysqli('localhost','root','','crud') or die(mysqli_error($mysqli));
    $name="";
    $location="";
    $update = false;
    $id="";
    
    if(isset($_REQUEST['save'])) {

        $name = $_REQUEST['name'];
        $location = $_REQUEST['location'];

        

        $mysqli->query("INSERT INTO data (name,location) VALUES('$name', '$location')") or die($mysqli->error);
        $_SESSION['message'] = "Record had been saved!";
        $_SESSION['msg_type'] = "success";

        header("location: index.php");
    }
    
        if(isset($_GET['delete'])) {
            $id = $_GET['delete'];
            $mysqli->query(" DELETE FROM data WHERE id=$id ") or die($mysqli->error);  

            $_SESSION['message'] = "Record had been deleted!";
            $_SESSION['msg_type'] = "danger";
        //    header("location: index.php");     thừa :D
            
        }

        if(isset($_GET['edit'])) {
            $id = $_GET['edit'];
            $result = $mysqli->query(" SELECT * FROM data WHERE id=$id ") or die($mysqli->error);  
            $update = true;
            if($result->num_rows) {
                $row = $result->fetch_array();
                $name = $row['name'];
                $location = $row['location'];
            }
            
        }

        if(isset($_POST['update'])) {
            $id = $_POST['id'];
            $name = $_REQUEST['name'];
            $location = $_REQUEST['location'];
            $mysqli->query("UPDATE data set name='$name', location='$location' WHERE id=$id ") or die($mysqli->error);  
            
            $_SESSION['message'] = "Record had been updated!";
            $_SESSION['msg_type'] = "warning";
            header("location: index.php");
        }


?>