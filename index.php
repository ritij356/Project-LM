 <?php
     session_start();
     error_reporting(0);
     include('includes/config.php');
     if($_SESSION['login']!='')
       {  if ($_POST["vercode"] != $_SESSION["vercode"] OR $_SESSION["vercode"]=='')  
               {echo "<script>alert('Incorrect verification code');</script>" ;  } 
          else {
               $email=$_POST['emailid'];
               $password=($_POST['password']);
               $sqlite ="SELECT EmailId,Password,StudentId,Status FROM tblstudents WHERE EmailId=:email and Password=:password";
               $query= $db -> prepare($sqlite);
               $query-> bindParam(':email', $email, PDO::PARAM_STR);
               $query-> bindParam(':password', $password, PDO::PARAM_STR);
               $query-> execute();  
              }
                if($query->rowCount() > 0)
                  { foreach ($results as $result) 
                  { $_SESSION['stdid']=$result->StudentId;
                    if($result->Status==1)
                       { $_SESSION['login']=$_POST['emailid'];  }  } } 
                else
                  { echo "<script>alert('Invalid');</script>";  }
        }
   ?>

  <!DOCTYPE html>
  <html>
   <head>
         <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
         <title>Online Library Management System</title>
         <link href="assets/css/bootstrap.css" rel="stylesheet">
         <link href="assets/css/style.css" rel="stylesheet">
    </head>
    <body>
       <?php include('includes/header.php');?>
       <h4>USER LOGIN FORM</h4>        

        <div class="row">
           <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" >
              <div class="panel panel-info">
                 <div class="panel-heading">LOGIN FORM</div>
                      <div class="panel-body">
                              <form role="form" method="post">
                               <div class="form-group"> 
                                  <label>Enter Email id</label>
                                  <input class="form-control" type="text" name="emailid" required autocomplete="off" />
                                </div>
                                <div class="form-group">
                                   <label>Password</label>
                                   <input class="form-control" type="password" name="password" required autocomplete="off"  />
                                   <p class="help-block"><a href="user-forgot-password.php">Forgot Password</a></p>
                                </div>
                                <div class="form-group">
                                    <label>Verification code : </label>
                                    <input type="text" class="form-control1"  name="vercode" maxlength="5" autocomplete="off" required  style="height:25px;" />&nbsp;<img src="captcha.php">
                                </div> 
                                <button type="submit" name="login" class="btn btn-info">LOGIN </button> | <a href="signup.php">Not Register Yet</a>
                              </form>
                      </div>
                  </div>
              </div>
           </div> 
         </div>
          
</body>
</html>
