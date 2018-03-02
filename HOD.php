<?php 
   session_start();
   $role = $_SESSION['sess_userrole'];
   if(!isset($_SESSION['sess_username'])){
     header('Location: index.php?err=2');
   }
   if($role!="HOD"){
     header('Location: index.php?err=2');
   }
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CSE-Hackathon</title>
      <!-- Bootstrap -->
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/style.css" rel="stylesheet">
      <style>
         /* Style the tab */
         div.tab {
         overflow: hidden;
         border: 1px solid #ccc;
         background-color: #f1f1f1;
         }
         /* Style the links inside the tab */
         div.tab a {
         float: left;
         display: block;
         color: black;
         text-align: center;
         padding: 14px 16px;
         text-decoration: none;
         transition: 0.3s;
         font-size: 17px;
         }
         /* Change background color of links on hover */
         div.tab a:hover {
         background-color: #ddd;
         }
         /* Create an active/current tablink class */
         div.tab a:focus, .active {
         background-color: #ccc;
         }
         /* Style the tab content */
         .tabcontent {
         display: none;
         padding: 6px 12px;
         border: 1px solid #ccc;
         border-top: none;
         }
      </style>
   </head>
   <body>
      <div class="navbar navbar-default navbar-fixed-top" role="navigation">
         <div class="container">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
               <span class="sr-only">My Campus My Idea</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               </button>
               <a class="navbar-brand" href="#"><I>CSE</I></a>
            </div>
            <div class="navbar-collapse collapse">
               <ul class="nav navbar-nav navbar-right">
                  <li><a href="#"><?php echo $_SESSION['sess_username'];?></a></li>
                  <li><a href="logout.php">Logout</a></li>
               </ul>
            </div>
         </div>
      </div>
      <div class="container homepage"  style="padding-top: 50px;">
         <div class="tab">
            <a href="javascript:void(0)" class="tablinks" onclick="openEvent(event, 'Apply_Leave')">Apply Leave</a>
            <a href="javascript:void(0)" class="tablinks" onclick="openEvent(event, 'Student_Request')">Student Request</a>
            <a href="javascript:void(0)" class="tablinks" onclick="openEvent(event, 'Staff_Request')">Staff Request</a>
            <a href="javascript:void(0)" class="tablinks" onclick="openEvent(event, 'History')">History</a>
            <a href="javascript:void(0)" class="tablinks" onclick="openEvent(event, 'Status')">Status</a>
         </div>
         <div id="Apply_Leave" class="tabcontent">
            <h3>Apply Leave</h3>
            <form method = "post" action = "">
               <table class="table table-bordered table-responsive">
                  <center>
                     <tr>Leave Form</tr>
                  </center>
                  <br>
                  <td>Employee ID.</td>
                  <td><?php echo $_SESSION['sess_user_id'];?></td>
                  <td></td>
                  <td></td>
                  <td>Date :</td>
                  <td><?php echo date("d/m/Y") ?></td>
                  </tr>
                  <tr>
                     <td>Name:</td>
                     <td><?php echo $_SESSION['sess_username'];?></td>
                  </tr>
                  <tr>
                     <td>From :</td>
                     <td><input type="date" placeholder="dd/mm/yyyy" name="fromDate"></td>
                  </tr>
                  <tr>
                     <td>To :</td>
                     <td><input type="date" placeholder="dd/mm/yyyy" name="toDate"></td>
                     <td></td>
                     <td>FN :</td>
                     <td><input type="checkbox" name="FN"></td>
                     <td>AN :</td>
                     <td><input type="checkbox" name="AN"></td>
                  </tr>
                  <tr>
                     <td>Reason For leave:</td>
                     <td><textarea name = "Reason" placeholder = "Reason" rows = "4" cols = "40"></textarea></td>
                  </tr>
                  <tr>
                     <td>Faculty Altered :</td>
                     <td><input type="text" placeholder="Faculty Altered" name="AlteredFaculty"></td>
                  </tr>
                  <hr>
                  <tr>
                     <td>Leave Type :</td>
                     <td><input type="radio" name="LeaveType" value="CL">CL</td>
                     <td><input type="radio" name="LeaveType" value="CLP">CLP</td>
                     <td><input type="radio" name="LeaveType" value="LOP">LOP</td>
                     <td><input type="radio" name="LeaveType" value="ML">ML</td>
                     <td> 
                     </td>
                     <td> 
                     </td>
                     <td> 
                     </td>
                  </tr>
               </table>
               <center><input type = "submit" name = "submit" value = "submit"> </center>
            </form>
         </div>
         <div id="Student_Request" class="tabcontent">
            <h3>Student Requests</h3>
            <?php
               require "database-config.php";
               
               $id = $_SESSION['sess_user_id'];
               
               echo $id;
               
               $getdept = 'SELECT * FROM staffdetails WHERE StaffID = :id';
               
                 $query = $dbh->prepare($getdept);
               
                 $query->execute(array(':id' => $id));
               
                 if($query->rowCount() > 0){
               
                   $row = $query->fetch(PDO::FETCH_ASSOC);
               
                   
                   $dept = $row['StaffDept'];
                 }
               
               
               
               
                 $getstud = 'SELECT * FROM studentleave where StudentDept >= :dept  AND Mentor_Approval = "Approved" AND Hod_Approval = "Pending" ORDER BY AppliedOn DESC';
               
                 $showleave = $dbh->prepare($getstud);
               
                 $showleave->execute(array(':dept' => $dept ));
               
                 if($showleave->rowCount() > 0){
               
                   print "<table border = 1 cellspacing = 5px cellpadding = 5% ; align = center>
                   <tr> <th> # </th> <th> Student ID </th> <th> Student Name </th> <th> Student Dept </th>  <th> From Date </th> <th>To Date</th> <th> Reason</th> <th>Applied On</th> <th>Staff Approved </th> <th>Approved By</th> <th>Hod Approved </th> </tr>";
               
                   
                   while($row = $showleave->fetch(PDO::FETCH_ASSOC)) {
                       print "<tr>";
                       print "<td> <input type = 'checkbox' name = 'temp' onClick='selectMultiple()' value = '".$row["AppliedOn"]."'/></td>";
                       print "<td> ". $row["StudentID"] . "</td>";
                       print "<td> ". $row["StudentName"]. "</td>";
                       print "<td> ". $row["StudentDept"]. "</td>";
                       print "<td> ". $row["FromDate"]. "</td>";
                       print "<td> ". $row["ToDate"]. "</td>";
                       print "<td> ". $row["Reason"]. "</td>";
                       print "<td> ". $row["AppliedOn"]. "</td>";
                       print "<td> ". $row["Mentor_Approval"]. "</td>";
                       print "<td> ". $row["Mentor_Name"]. "</td>";
                       print "<td> <form action='' method='POST'><input type='hidden' name='tempId' value='".$row["AppliedOn"]."'/>
                                   <input type='submit' name='btn-approve' value='Approve' />
                                   <input type='submit' name='btn-reject' value='Reject' />
                                   <form></td>";   
                       print "</tr>";
                     }
                     print "</table>";
                     print "<input type='submit' name='btn-approve' value='Approve' />
                                   <input type='submit' name='btn-reject' value='Reject' />";
                     
                   }else{
                       print "No Record Found..!!!! ";
                 }
                 function selectMultiple() {
                   alert("Selct clicked");
                 }
               
                  ?>
            <?php
               require 'database-config.php';
               if(isset($_POST["btn-approve"])){
                   extract($_POST);
                   $tempid = $_POST['tempId'];
                   $sql = "UPDATE studentleave SET Hod_Approval='Approved' WHERE AppliedOn = :temp";
               
                 $stmt = $dbh->prepare($sql);
               
                 $stmt->execute(array(':temp' => $tempid));
               }
               
               
               ?>
            <?php
               require 'database-config.php';
               if(isset($_POST["btn-reject"])){
                   extract($_POST);
                   $tempid = $_POST['tempId'];
                   $sql = "UPDATE studentleave SET Hod_Approval='Rejected' WHERE AppliedOn = :temp";
               
                 $stmt = $dbh->prepare($sql);
               
                 $stmt->execute(array(':temp' => $tempid));
               
               }
               
               ?>
         </div>
         <div id="Staff_Request" class="tabcontent">
            <h3>Staff Requests</h3>
            <?php
               require "database-config.php";
               
               $id = $_SESSION['sess_user_id'];
               
               echo $id;
               
               $getdept = 'SELECT * FROM staffdetails WHERE StaffID = :id';
               
                 $query = $dbh->prepare($getdept);
               
                 $query->execute(array(':id' => $id));
               
                 if($query->rowCount() > 0){
               
                   $row = $query->fetch(PDO::FETCH_ASSOC);
               
                   
                   $dept = $row['StaffDept'];
                 }
               
               
               
               
                 $getstud = 'SELECT * FROM staffleave where StaffDept >= :dept  AND Role != "HOD" AND Hod_Approval = "Pending" ORDER BY AppliedOn DESC';
               
                 $showleave = $dbh->prepare($getstud);
               
                 $showleave->execute(array(':dept' => $dept ));
               
                 if($showleave->rowCount() > 0){
               
                   print "<table border = 1 cellspacing = 5px cellpadding = 5% ; align = center>
                   <tr> <th> Student ID </th> <th> Student Name </th> <th> Student Dept </th>  <th> From Date </th> <th>To Date</th> <th> Reason</th> <th>Applied On</th> <th>leave Type </th> <th>Faculty Altered </th> <th>Hod Approval</th> </tr>";
               
                   
                   while($row = $showleave->fetch(PDO::FETCH_ASSOC)) {
                       print "<tr>";
                       print "<td> ". $row["StaffID"] . "</td>";
                       print "<td> ". $row["StaffName"]. "</td>";
                       print "<td> ". $row["StaffDept"]. "</td>";
                       print "<td> ". $row["FromDate"]. "</td>";
                       print "<td> ". $row["ToDate"]. "</td>";
                       print "<td> ". $row["Reason"]. "</td>";
                       print "<td> ". $row["AppliedOn"]. "</td>";
                       print "<td> ". $row["LeaveType"]. "</td>";
                       print "<td> ". $row["AlteredFaculty"]. "</td>";
                       print "<td> <form action='' method='POST'><input type='hidden' name='tempId' value='".$row["AppliedOn"]."'/>
                                   <input type='submit' name='btn-staff-approve' value='Approve' />
                                   <input type='submit' name='btn-staff-reject' value='Reject' />
                                   <form></td>";
                       print "</tr>";
                     }
                     print "</table>";
                   }else{
                       print "No Record Found..!!!! ";
                 }
                  ?>
            <?php
               require 'database-config.php';
               if(isset($_POST["btn-staff-approve"])){
                   extract($_POST);
                   $tempid = $_POST['tempId'];
                   $sql = "UPDATE staffleave SET Hod_Approval='Approved' WHERE AppliedOn = :temp";
               
                 $stmt = $dbh->prepare($sql);
               
                 $stmt->execute(array(':temp' => $tempid));
               }
               
               
               ?>
            <?php
               require 'database-config.php';
               if(isset($_POST["btn-staff-reject"])){
                   extract($_POST);
                   $tempid = $_POST['tempId'];
                   $sql = "UPDATE staffleave SET Hod_Approval='Rejected' WHERE AppliedOn = :temp";
               
                 $stmt = $dbh->prepare($sql);
               
                 $stmt->execute(array(':temp' => $tempid));
               
               }
               
               ?>
         </div>
         <div id="History" class="tabcontent">
            <h3>History</h3>
            <?php
               require "database-config.php";
               
               $id = $_SESSION['sess_user_id'];
               
               echo $id;
               
               
               
                 $gethist = 'SELECT * FROM staffleave where StaffID = :id ORDER BY AppliedOn DESC';
               
                 $query = $dbh->prepare($gethist);
               
                 $query->execute(array(':id' => $id));
               
                 if($query->rowCount() > 0){
               
                   print "<table border = 1 cellspacing = 5px cellpadding = 5% ; align = center>
                   <tr> <th> Staff ID </th> <th> Staff Dept </th> <th> From Date </th> <th>To Date</th> <th> Reason</th> <th> Applied On</th> <th>Altered Faculty </th> <th>Leave Type </th> <th>Principal</th>     </tr>";
               
                   
                   while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                       print "<tr>";
                       print "<td> ". $row["StaffID"] . "</td>";
                       print "<td> ". $row["StaffDept"]. "</td>";
                       print "<td> ". $row["FromDate"]. "</td>";
                       print "<td> ". $row["ToDate"]. "</td>";
                       print "<td> ". $row["Reason"]. "</td>";
                       print "<td> ". $row["AppliedOn"]. "</td>";
                       print "<td> ". $row["AlteredFaculty"]. "</td>";
                       print "<td> ". $row["LeaveType"]. "</td>";
                       print "<td> ". $row["Principal_Approval"]. "</td>"; 
                       print "</tr>";
                     }
                     print "</table>";
                   }else{
                       print "No Record Found..!!!! ";
                 }
                  ?>
         </div>
         <div id="Status" class="tabcontent">
            <h3>Status</h3>
            <?php
               require "database-config.php";
               
               $id = $_SESSION['sess_user_id'];
               
               echo $id;
               
               
               
                 $gethist = 'SELECT * FROM staffleave where StaffID = :id ORDER BY AppliedOn DESC LIMIT 1';
               
                 $query = $dbh->prepare($gethist);
               
                 $query->execute(array(':id' => $id));
               
                 if($query->rowCount() > 0){
               
                   print "<table border = 1 cellspacing = 5px cellpadding = 5% ; align = center>
                   <tr> <th> Staff ID </th> <th> Staff Dept </th> <th> From Date </th> <th>To Date</th> <th> Reason</th> <th> Applied On</th> <th>Altered Faculty </th> <th>Leave Type </th> <th>Principal</th>     </tr>";
               
                   
                   while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                       print "<tr>";
                       print "<td> ". $row["StaffID"] . "</td>";
                       print "<td> ". $row["StaffDept"]. "</td>";
                       print "<td> ". $row["FromDate"]. "</td>";
                       print "<td> ". $row["ToDate"]. "</td>";
                       print "<td> ". $row["Reason"]. "</td>";
                       print "<td> ". $row["AppliedOn"]. "</td>";
                       print "<td> ". $row["AlteredFaculty"]. "</td>";
                       print "<td> ". $row["LeaveType"]. "</td>";
                       print "<td> ". $row["Principal_Approval"]. "</td>"; 
                       print "</tr>";
                     }
                     print "</table>";
                   }else{
                       print "No Record Found..!!!! ";
                 }
                  ?>
         </div>
      </div>
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="js/bootstrap.min.js"></script>
      <script>
         function openEvent(evt, action) {
         // Declare all variables
         var i, tabcontent, tablinks;
         
         // Get all elements with class="tabcontent" and hide them
         tabcontent = document.getElementsByClassName("tabcontent");
         for (i = 0; i < tabcontent.length; i++) {
           tabcontent[i].style.display = "none";
         }
         
         // Get all elements with class="tablinks" and remove the class "active"
         tablinks = document.getElementsByClassName("tablinks");
         for (i = 0; i < tablinks.length; i++) {
           tablinks[i].className = tablinks[i].className.replace(" active", "");
         }
         
         // Show the current tab, and add an "active" class to the link that opened the tab
         document.getElementById(action).style.display = "block";
         evt.currentTarget.className += " active";
         }
         
         // Get the element with id="defaultOpen" and click on it
         document.getElementById("defaultOpen").click();
      </script>
   </body>
</html>
<?php
   require 'database-config.php';
       $id = $_SESSION['sess_user_id'];
       $name = $_SESSION['sess_username'];
       $role = $_SESSION['sess_userrole'];
   
   
     if(isset($_POST["submit"])){
     extract($_POST);
     
     $from = $_POST['fromDate'];
     $to = $_POST['toDate'];
     $Reason = $_POST['Reason'];
     $AlteredFaculty = $_POST['AlteredFaculty'];
     $LeaveType = $_POST['LeaveType'];
   
     $dept=""; 
   
   
           $getdept = 'SELECT * FROM staffdetails WHERE StaffID = :id';
   
     $query = $dbh->prepare($getdept);
   
     $query->execute(array(':id' => $id));
   
     if($query->rowCount() > 0){
   
       $row = $query->fetch(PDO::FETCH_ASSOC);
   
       
       $dept = $row['StaffDept'];
     }
     $ins='INSERT into staffleave (StaffID,StaffName,StaffDept,Role,FromDate,ToDate,Reason,AlteredFaculty,LeaveType) values (:id,:name,:dept,:role,:from,:to,:Reason,:AlteredFaculty,:LeaveType)';
     $query = $dbh->prepare($ins);
   
     $query->execute(array(':id' => $id, ':name' => $name, ':dept' => $dept, ':role' => $role, ':from' => $from, ':to' => $to, ':Reason' => $Reason, ':AlteredFaculty' => $AlteredFaculty, ':LeaveType' =>  $LeaveType));
   
     
     }
       
   ?>