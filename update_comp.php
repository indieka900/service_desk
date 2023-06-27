<?php 
    include("database2.php");

    $db= $conn;
    $tableName="complaints";

    $issue = $_POST['form2'];
    $msg = update_complaint($db, $issue, );
    echo $msg;


    function update_complaint ($db, $issue){
        
        $query = "UPDATE complaints SET Status= 'Complete' WHERE ComplaintId = '$issue' ";
        $result = $db->query($query);
        if($result== true){ 
            header("Location: ".$_SERVER['HTTP_REFERER']);
        }else{
            header("Location: ".$_SERVER['HTTP_REFERER']);
            $msg= mysqli_error($db);
        }
        
        
        return $msg;
    }
?>