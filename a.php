<?php
if(isset($_POST['submit']))
{
  session_start();
  require_once "config/pdo.php";
  $msg="";
  //Checking if the details are entered
  if (isset($_POST['Name']) && isset($_POST['Password']) && isset($_POST['email']) && isset($_POST['DOB']) && isset($_POST['Pdesc']) && isset($_POST['Gender']))
  {
    //Checking if the password and retype password fields match
    //if($_POST['password1']==$_POST['password2'] && strlen($_POST['password1'])>=7)
	 // {
      //Encrypting the password for security
      $psw=hash('md5',$_POST['Password']);
      //The SQL Query to enter the data as a row in the database
      $type = $_POST('Type');
      if($type == 'Author')
          $sql= "INSERT Into creator(name,followers,email,password,dob,age,description,gender) values(:n,:f,:e,:p,:dob,:a,:d,:g)";
      else 
      $sql= "INSERT Into creator(name,email,password,dob,description,gender) values(:n,:e,:p,:dob,:d,:p)";
      //Execute query
      $stmt= $pdo->prepare($sql);
      $stmt->execute(array(
        'n:' => $_POST['Name'],
        ':f' => 1000,
        ':e' => $_POST['email'],
        ':p' => $psw,
        ':dob' => $_POST['DOB'],
        ':a' => 21,
        ':d' => $_POST['PDesc'],
        ':g' => $_POST['Gender'],
      ));
      //Action after executing query
      header("Location: dashboard.php");
      echo '<script>alert("An account has been created successfully!")</script>';
    //}
    /*else
    {
      //Error message displayed when passwords dont match
      $msg="Passwords dont match";
    }*/
    if(strlen($_POST['password1'])<7)
    {
      //Error message displayed when password is too short
      $msg="Password too short";
    }
  }
}
?>