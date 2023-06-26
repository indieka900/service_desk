<?php
include("database2.php");

$db= $conn;
$tableName="complaints";
$columns= ['ComplaintId', 'Location','Department','Description','Timestart','Status','Expert_assigned'];
$fetchData = fetch_recent_comp($db, $tableName, $columns);
$fetchSolved = fetch_solved_comp($db, $tableName, $columns);
$fetchPending = fetch_pending_comp($db, $tableName, $columns);
$fetchAll = fetch_all_comp($db, $tableName, $columns);
$totalRows = fetc_total_rows($db, $tableName);
$pending = fetc_pending_rows($db, $tableName);
$complete = fetc_complete_rows($db, $tableName);

//Fetch the recent complaints from database
function fetch_recent_comp($db, $tableName, $columns){
   if(empty($db)){
   $msg= "Database connection error";
   }elseif (empty($columns) || !is_array($columns)) {
   $msg="columns Name must be defined in an indexed array";
   }elseif(empty($tableName)){
   $msg= "Table Name is empty";
   }else{

   $columnName = implode(", ", $columns);
   $query = "SELECT ".$columnName." FROM $tableName"." ORDER BY Timestart DESC"." LIMIT 3";
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
function fetch_solved_comp($db, $tableName, $columns){
   if(empty($db)){
   $msg= "Database connection error";
   }elseif (empty($columns) || !is_array($columns)) {
   $msg="columns Name must be defined in an indexed array";
   }elseif(empty($tableName)){
   $msg= "Table Name is empty";
   }else{

   $columnName = implode(", ", $columns);
   $query = "SELECT ".$columnName." FROM $tableName"." WHERE Status = 'Complete'"." ORDER BY Timestart DESC";
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
function fetch_pending_comp($db, $tableName, $columns){
   if(empty($db)){
   $msg= "Database connection error";
   }elseif (empty($columns) || !is_array($columns)) {
   $msg="columns Name must be defined in an indexed array";
   }elseif(empty($tableName)){
   $msg= "Table Name is empty";
   }else{

   $columnName = implode(", ", $columns);
   $query = "SELECT ".$columnName." FROM $tableName"." WHERE Status = 'Pending'"." ORDER BY Timestart DESC"." LIMIT 3";
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
function fetch_all_comp($db, $tableName, $columns){
   if(empty($db)){
   $msg= "Database connection error";
   }elseif (empty($columns) || !is_array($columns)) {
   $msg="columns Name must be defined in an indexed array";
   }elseif(empty($tableName)){
   $msg= "Table Name is empty";
   }else{

   $columnName = implode(", ", $columns);
   $query = "SELECT ".$columnName." FROM $tableName"." ORDER BY Timestart DESC";
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


//Fetch the total number of rows of complaints from database
function fetc_total_rows($db, $tableName,){
   if(empty($db)){
      $msg= "Database connection error";
   }elseif(empty($tableName)){
      $msg= "Table Name is empty";
   }else{
      $sql = "SELECT COUNT(*) AS total_rows FROM $tableName";
      $result1 = mysqli_query($db, $sql);
      if ($result1) {
            $row = mysqli_fetch_assoc($result1);
            $totalRows = $row['total_rows'];

            return $totalRows;
      } else {
            echo "Error: " . mysqli_error($db);
      }
   }
}


//fetch the number of rows of the completed/solved complaints
function fetc_complete_rows($db, $tableName,){
   if(empty($db)){
      $msg= "Database connection error";
   }elseif(empty($tableName)){
      $msg= "Table Name is empty";
   }else{
      $sql = "SELECT COUNT(*) AS complete_rows FROM $tableName WHERE Status = 'Complete'";
      $result1 = mysqli_query($db, $sql);
   if ($result1) {
      $row = mysqli_fetch_assoc($result1);
      $complete = $row['complete_rows'];
      return $complete;
   } else {
      echo "Error: " . mysqli_error($db);
   }
   }
}


//fetch the number of rows of the pending complaints
function fetc_pending_rows($db, $tableName,){
 if(empty($db)){
  $msg= "Database connection error";
 }elseif(empty($tableName)){
   $msg= "Table Name is empty";
}else{
   $sql = "SELECT COUNT(*) AS pending_rows FROM $tableName WHERE Status = 'Pending'";
   $result = $db->query($sql);
   if ($result) {
      $row = mysqli_fetch_assoc($result);
      $pending = $row['pending_rows'];
      return $pending;
   } else {
      echo "Error: " . mysqli_error($db);
   }
   }
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