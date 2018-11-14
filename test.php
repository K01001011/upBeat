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
    if(isset($_POST['new']) && $_POST['new']==1 && isset($_POST['admin'])){
        $user = $_REQUEST['username'];
        $pass = $_REQUEST['password'];
        $search_query="select * from Users where USERNAME='$user'";
        $result = mysqli_query($con,$search_query)
        or die(mysqli_error($con));
        $row = mysqli_fetch_assoc($result);
        if(strcmp($user, "upbeat") == 0 &&  strcmp(sha1($pass), $row["Password"]) == 0)
        {
            $status = "SUCCESS";
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['name'] = $user;
            header("Location:admin.php");
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
            <div class = "row">
                <div class = "col" align="center">
                <div class = "container-fluid mycontainer">
                    <h1>Upbeat</h1>
                    <br>
                    <form name="form" method="post" action=""> 
                        <input type="hidden" name="new" value="1" />
                        <p><input type="text" name="username" placeholder="Enter username" required /></p>
                        <p><input type="password" name="password" placeholder="Enter password" required /></p>
                        <br>
                        <button  name="login" type="submit" class="btn btn-primary">Sign in</button>
                        <button name="signup" type="submit" class="btn btn-primary">Sign up</button>
                        <button name="admin" type="submit" class="btn btn-primary">Admin</button>
                        <!-- <p><input name="login" type="submit" value="SIGN IN" />
                        <p><input name="signup" type="submit" value="SIGN UP" /></p> -->
                    </form>
                    <p style="color:#FF0000;"><?php echo $status; ?></p>
                </div>
            </div>
            </div>
        </div>
    </body>
</html>