<?php
    require('db.php');
    $status = "";
    if(isset($_POST['new']) && $_POST['new']==1 && isset($_POST['login'])){
        $user = $_REQUEST['username'];
        $pass = $_REQUEST['password'];
        $search_query="select * from Users where USERNAME='$user'";
        $result = mysqli_query($con,$search_query)
        or die(mysqli_error($con));
        $row = mysqli_fetch_assoc($result);
        if($row["Password"] == sha1($pass))
        {
            $status = "SUCCESS";
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['name'] = $user;
            header("Location:main.php");
        }
        else
            $status = "FAIL";
    }
    if(isset($_POST['new']) && $_POST['new']==1 && isset($_POST['signup'])){
        $user = $_REQUEST['username'];
        $pass = $_REQUEST['password'];
        $search_query="select count(*) as num from Users where USERNAME='$user'";
        $result = mysqli_query($con,$search_query)
        or die(mysqli_error($con));
        $row = mysqli_fetch_assoc($result);
        if($row["num"] == 0)
        {
            $pass = sha1($pass);
            $ins_query="insert into Users values ('$user', '$pass')";
            mysqli_query($con,$ins_query)
            or die('error');
            $status = "Created";
        }
        else
            $status = "FAIL";
    }
?>  
<!DOCTYPE html>
<html>
    <head>
        <title>DBMS</title>
       
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="style.css" rel="stylesheet" />
        
    </head>
    <body>

        <div id = "home">
            <div class = "container-fluid">
                <h1>WELCOME</h1>
                <form name="form" method="post" action=""> 
                    <input type="hidden" name="new" value="1" />
                    <p><input type="text" name="username" placeholder="ENTER USERNAME" required /></p>
                    <p><input type="password" name="password" placeholder="ENTER PASSWORD" required /></p>
                    <p><input name="login" type="submit" value="SIGN IN" />
                    <p><input name="signup" type="submit" value="SIGN UP" /></p>
                </form>
                <p style="color:#FF0000;"><?php echo $status; ?></p>
            </div>
        </div>

        <div class="form">
            
            <!-- <p><a href="insert.php">Insert</a></p>
            <p><a href="select.php">View</a><p>
            <p><a href="delete.php">Delete</a><p> -->
        </div>
    </body>
</html>