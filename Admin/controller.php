<?php
    session_start();
    include("includes/sqlconnection.php");

    if(isset($_POST['save_promo'])){

        $promo = $_POST['txtpromo'];
        
        $sql = "INSERT INTO tbl_promo(promoCode) VALUES ('$promo')";

        if($conn->query($sql)===TRUE){
            $_SESSION['status'] = "Promo Code Added Successfully";
            header('location:admin.php');

        } else {
            $_SESSION['status'] = "Error: Insert Failed";
            header('location:admin.php');
            

        }

        $conn->close();

    } 
    
    if(isset($_POST['save_bank'])){

        $bank = $_POST['txtbank'];
        
        $sql = "INSERT INTO tbl_bankpayment(bankName) VALUES ('$bank')";

        if($conn->query($sql)===TRUE){
            $_SESSION['status'] = "Bank Added Successfully";
            header('location:admin.php');

        } else {
            $_SESSION['status'] = "Error: Insert Failed";
            header('location:admin.php');
            

        }

        $conn->close();

    } 
    if(isset($_POST['save_ewallet'])){

        $ewallet = $_POST['txtewallet'];
        
        $sql = "INSERT INTO tbl_epayment(ewallet) VALUES ('$ewallet')";

        if($conn->query($sql)===TRUE){
            $_SESSION['status'] = "E-Wallet Added Successfully";
            header('location:admin.php');

        } else {
            $_SESSION['status'] = "Error: Insert Failed";
            header('location:admin.php');
            

        }

        $conn->close();

    } 

    if(isset($_POST['save_branch'])){

        $branch = $_POST['txtbranch'];
        
        $sql = "INSERT INTO tbl_branches(branch) VALUES ('$branch')";

        if($conn->query($sql)===TRUE){
            $_SESSION['status'] = "Branch Added Successfully";
            header('location:admin.php');

        } else {
            $_SESSION['status'] = "Error: Insert Failed";
            header('location:admin.php');
            

        }

        $conn->close();

    } 

    if(isset($_POST['save_shoe'])){

        $image = $_FILES['txtimage']['name'];
        $name = $_POST['txtname'];
        $star = $_POST['txtstar'];
        $price = $_POST['txtprice'];
        $category = $_POST['txtcategory'];
        $brand = $_POST['txtbrand'];


        $sql = "INSERT INTO catalog(image,name,star,price,category,brand)VALUES('$image','$name','$star','$price','$category','$brand')";

        if($conn->query($sql)===TRUE){

            move_uploaded_file($_FILES["txtimage"]["tmp_name"],"uploads/".$_FILES['txtimage']['name']);
            $_SESSION['status'] = "Shoe Added Successfully";
            header('location:admin.php');

        } else {
            $_SESSION['status'] = "Error: Insert Failed";
            header('location:admin.php');
            

        }

        $conn->close();

    } 

    if(isset($_POST['update_shoe'])){

        $id = $_POST['txtid'];
        $image_new = $_FILES['txtimage']['name'];
        $image_old = $_POST['txtimage_old'];
        $name = $_POST['txtname'];
        $star = $_POST['txtstar'];
        $price = $_POST['txtprice'];
        $category = $_POST['txtcategory'];
        $brand = $_POST['txtbrand'];

        if($image_new !=''){
            $update_image = $image_new;
        } else {
            $update_image = $image_old;
        }

        echo "$update_image";

        $sql = "UPDATE catalog SET image='$update_image', name='$name', star='$star', price='$price', category='$category', brand='$brand' WHERE id='$id'";

        if($conn->query($sql)===TRUE){
    
            move_uploaded_file($_FILES["txtimage"]["tmp_name"],"uploads/".$_FILES['txtimage']['name']);
            $_SESSION['status'] = "Shoe Updated Successfully";
            header('location:admin.php');
    
        } else {

            $_SESSION['status'] = "Error: Update Failed";
            header('location:admin.php');
        }

        $conn->close();

    }

    if(isset($_GET['eID'])){
        
        $id = $_GET['eID'];
    

        $sql = "DELETE FROM tbl_epayment WHERE eID ='$id'";

        if($conn->query($sql) === TRUE){

            $_SESSION['status'] ="Shoe Deleted Successfully";
            header('location:admin.php');
    
        } else {

            $_SESSION['status'] ="Deletion Failed";
            header('location:admin.php');

        }

        $conn->close();


    }

    if(isset($_GET['branchID'])){
        
        $id = $_GET['branchID'];
    

        $sql = "DELETE FROM tbl_branches WHERE branchID ='$id'";

        if($conn->query($sql) === TRUE){

            $_SESSION['status'] ="Shoe Deleted Successfully";
            header('location:admin.php');
    
        } else {

            $_SESSION['status'] ="Deletion Failed";
            header('location:admin.php');

        }

        $conn->close();


    }

    if(isset($_GET['id'])){
        
        $id = $_GET['id'];
        $image = $_GET['image'];

        $sql = "DELETE FROM catalog WHERE id ='$id'";

        if($conn->query($sql) === TRUE){

            unlink("uploads/".$image);
            $_SESSION['status'] ="Shoe Deleted Successfully";
            header('location:admin.php');
    
        } else {

            $_SESSION['status'] ="Deletion Failed";
            header('location:admin.php');

        }

        $conn->close();


    }


    



?>