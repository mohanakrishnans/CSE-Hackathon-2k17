<?php 
   require 'database-config.php';
   
   session_start();
   
   $username = "";
   $password = "";
   
   if(isset($_POST['username'])){
   	$username = $_POST['username'];
   }
   if (isset($_POST['password'])) {
   	$password = $_POST['password'];
   
   }
   
   echo $username ." : ".$password;
   
   $q = 'SELECT * FROM userlogin WHERE UserID=:username AND Password=:password';
   
   $query = $dbh->prepare($q);
   
   $query->execute(array(':username' => $username, ':password' => $password));
   
   if($query->rowCount() == 0){
   	header('Location: index.php?err=1');
   }else{
   
   	$row = $query->fetch(PDO::FETCH_ASSOC);
   
   	session_regenerate_id();
   	$_SESSION['sess_user_id'] = $row['UserID'];
   	$_SESSION['sess_username'] = $row['UserName'];
          $_SESSION['sess_userrole'] = $row['Role'];
   
          echo $_SESSION['sess_userrole'];
   	session_write_close();
   
   	if( $_SESSION['sess_userrole'] == "Student"){
   		header('Location: Student.php');
   	}else if( $_SESSION['sess_userrole'] == "Principal"){
   		header('Location: Principal.php');
   	}else if( $_SESSION['sess_userrole'] == "HOD"){
   		header('Location: HOD.php');
   	}else{
   		header('Location: Mentor.php');
   	}
   	
   	
   }
   
   
   ?>