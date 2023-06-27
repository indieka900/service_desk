<?php
include("database2.php");

$db= $conn;
$tableName="complaints";
$fetchData = fetch_recent_comp($db, $tableName);
$fetchSolved = fetch_solved_comp($db, $tableName);
$fetchPending = fetch_pending_comp($db, $tableName);
$fetchAssigned = fetch_assigned_comp($db, $tableName);
$fetchAll = fetch_all_comp($db, $tableName);
$experts = fetch_users($db);



if (isset($_POST['expert'])) {
   $issue = $_POST['issue'];
   $expertId = $_POST['expert'];
   $msg = update_complaint($db, $issue, $expertId);
   echo $msg;
} else {
   // handle case where expert field is not set
}

// Warning: Undefined array key "expert" in C:\xampp\htdocs\service_desk\developer.php on line 17



function update_complaint ($db, $issue, $expert){
   if(empty($expert)){
      $msg= "Please select an expert";
      error_log($msg);
      header("Location: pending_comp.php?error=" . urlencode($msg));
      exit();
   }else {
      $query = "UPDATE complaints SET Expert_assigned = '$expert', Status= 'Assigned' WHERE ComplaintId = '$issue' ";
      $result = $db->query($query);
      if($result== true){ 
         header("Location: ".$_SERVER['HTTP_REFERER']);
      }else{
         header("Location: ".$_SERVER['HTTP_REFERER']);
         $msg= mysqli_error($db);
      }
   }
   
   return $msg;
}

//Fetch the recent complaints from database
function fetch_recent_comp($db, $tableName){
   if(empty($db)){
   $msg= "Database connection error";
   }elseif(empty($tableName)){
   $msg= "Table Name is empty";
   }else{
   $query = "SELECT "."*"." FROM $tableName"." ORDER BY Status DESC"." LIMIT 3";
   $result = $db->query($query);

   if($result== true){ 
   if ($result->num_rows > 0) {
      $row= mysqli_fetch_all($result, MYSQLI_ASSOC);
      $msg= $row;
   } else {
      $msg= "No Data Found"; 
   }
   }else{
   $msg= mysqli_error($db);
   }
   }
   return $msg;
}


//Fetch Users from database
function fetch_users($db){
   if(empty($db)){
   $msg= "Database connection error";
   }else{
   $query = "SELECT Name FROM users WHERE AOS != 'Worker' AND Status = 'Online'";
   $result = $db->query($query);

   if($result== true){ 
   if ($result->num_rows > 0) {
      $row= mysqli_fetch_all($result, MYSQLI_ASSOC);
      $msg= $row;
   } else {
      $msg= "No Data Found"; 
   }
   }else{
   $msg= mysqli_error($db);
   }
   }
   return $msg;
}


//Fetch the solved complaints from database
function fetch_solved_comp($db, $tableName){
   if(empty($db)){
   $msg= "Database connection error";
   }elseif(empty($tableName)){
   $msg= "Table Name is empty";
   }else{
   $query = "SELECT "."*"." FROM $tableName"." WHERE Status = 'Complete'"." ORDER BY Timestart DESC";
   $result = $db->query($query);

   if($result== true){ 
   if ($result->num_rows > 0) {
      $row= mysqli_fetch_all($result, MYSQLI_ASSOC);
      $msg= $row;
   } else {
      $msg= "No Data Found"; 
   }
   }else{
   $msg= mysqli_error($db);
   }
   }
   return $msg;
}
//Fetch the pending complaints from database
function fetch_pending_comp($db, $tableName){
   if(empty($db)){
   $msg= "Database connection error";
   }elseif(empty($tableName)){
   $msg= "Table Name is empty";
   }else{
   $query = "SELECT "."*"." FROM $tableName"." WHERE Status = 'Pending'"." ORDER BY Timestart DESC"." LIMIT 3";
   $result = $db->query($query);

   if($result== true){ 
   if ($result->num_rows > 0) {
      $row= mysqli_fetch_all($result, MYSQLI_ASSOC);
      $msg= $row;
   } else {
      $msg= "No Data Found"; 
   }
   }else{
   $msg= mysqli_error($db);
   }
   }
   return $msg;
}

//Fetch the assigned complaints from database
function fetch_assigned_comp($db, $tableName){
   if(empty($db)){
   $msg= "Database connection error";
   }elseif(empty($tableName)){
   $msg= "Table Name is empty";
   }else{
   $query = "SELECT "."*"." FROM $tableName"." WHERE Status = 'Assigned'"." ORDER BY Timestart DESC"." LIMIT 3";
   $result = $db->query($query);

   if($result== true){ 
   if ($result->num_rows > 0) {
      $row= mysqli_fetch_all($result, MYSQLI_ASSOC);
      $msg= $row;
   } else {
      $msg= "No Data Found"; 
   }
   }else{
   $msg= mysqli_error($db);
   }
   }
   return $msg;
}

//Fetch the all complaints from database
function fetch_all_comp($db, $tableName, ){
   if(empty($db)){
   $msg= "Database connection error";
   }elseif(empty($tableName)){
   $msg= "Table Name is empty";
   }else{
   $query = "SELECT "."*"." FROM $tableName"." ORDER BY Timestart DESC";
   $result = $db->query($query);

   if($result== true){ 
   if ($result->num_rows > 0) {
      $row= mysqli_fetch_all($result, MYSQLI_ASSOC);
      $msg= $row;
   } else {
      $msg= "No Data Found"; 
   }
   }else{
   $msg= mysqli_error($db);
   }
   }
   return $msg;
}

//convert the date and time to relative time
function convertToRelativeTime($datetime) {
   $timestamp = strtotime($datetime);
   $currentTimestamp = time();
   $difference = $currentTimestamp - $timestamp;
   if ($difference < 60) {
       $timeAgo = $difference . " seconds ago";
   } elseif ($difference < 3600) {
       $minutes = floor($difference / 60);
       $timeAgo = $minutes . " minute" . ($minutes > 1 ? "s" : "") . " ago";
   } elseif ($difference < 86400) {
       $hours = floor($difference / 3600);
       $timeAgo = $hours . " hour" . ($hours > 1 ? "s" : "") . " ago";
   } else {
       $days = floor($difference / 86400);
       $timeAgo = $days . " day" . ($days > 1 ? "s" : "") . " ago";
   }

   return $timeAgo;
}
?>