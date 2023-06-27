<?php
include("developer.php");
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> 
    <link rel="stylesheet" href="style1.css"> 
     
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>ICT OFFICER</title> 
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="images/logo.png" alt="">
            </div>

            <span class="logo_name">ICT OFFICER</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="service_desk.php">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Dashboard</span>
                </a></li>
                <li><a href="complaints.php">
                    <i class="uil uil-files-landscapes"></i>
                    <span class="link-name">Complaints</span>
                </a></li>
                <li><a href="solved_comp.php">
                            <i class="uil uil-files-landscapes"></i>
                            <span class="link-name">solved complaints</span>
                        </a></li>
                <li><a href="#">
                    <i class="uil uil-files-landscapes"></i>
                    <span class="link-name">Pending Complaints</span>
                </a></li>
                <li><a href="#">
                    <i class="uil uil-files-landscapes"></i>
                    <span class="link-name">Raise complaint</span>
                </a></li>
                <li><a href="#">
                    <i class="uil uil-files-landscapes"></i>
                    <span class="link-name">Transfer Complaints</span>
			
            </ul>
            
            <ul class="logout-mode">
                <li><a href="#">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a></li>

                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                    <span class="link-name">Dark Mode</span>
                </a>

                <div class="mode-toggle">
                  <span class="switch"></span>
                </div>
            </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here...">
            </div>
            
            <img src="images/profile.png" alt="">
        </div>

        <div class="dash-content">
          <div class="activity">
                <div class="title">
                    <i class="uil uil-clock-three"></i>
                    <span class="text">Pending Complaints</span>
                    <a href="#" class="notification">
                    <span class="badge">
                        <?php 
                            if(is_array($fetchPending)) {
                                $number = count($fetchPending);
                                echo $number;
                                } else {
                                echo 0;
                                }
                        ?>
                    </span>
                    </a>

                </div>

                <div class="activity-data">
                    <table>
                        <thead>
                            <tr>
                                <td>
                                    <div class="data st">
                                        <span >COMPLAINT ID</span>
                                    </div>
                                    
                                </td>
                                <td>
                                    <div class="data st">
                                        <span >DEPARTMENT</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="data st">
                                        <span >LOCATION</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="data st">
                                        <span >DURATION</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="data st">
                                        <span >STATUS</span>
                                    </div>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if(is_array($fetchPending)){      
                            $sn=1;
                            foreach($fetchPending as $data){
                            ?>
                            <tr >
                            <td><?php echo $data['ComplaintId']??''; ?></td>
                            <td><?php echo $data['Department']??''; ?></td>
                            <td><?php echo $data['Location']??''; ?></td>
                            <td><?php echo convertToRelativeTime($data['Timestart']); ?></td>
                            <td>
                                <form action="developer.php" method="post">
                                <input type="text" style="display: none;" id="issue" name="issue" value=<?php echo $data['ComplaintId']; ?>>
                                    <label for="expert">Assign Expert:</label>
                                    <select id="expert" name="expert">
                                        <option value="">Select an expert</option>
                                        <?php foreach ($experts as $expert): ?>
                                        <option value = <?php echo $expert['Name']; ?>>
                                            <?php echo $expert['Name']; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <input type="submit" value="Assign" >
                                </form>
                            </td>
                            </tr>
                            <?php
                            $sn++;}}else{ ?>
                            <tr>
                                <td colspan="8">
                            <?php echo $fetchPending; ?>
                            </td>
                            <tr>
                            <?php
                            }
                            ?>
                            </tbody>
                    </table>
                </div>
                <div class="title">
                    <i class="uil uil-clock-three"></i>
                    <span class="text">Assigned Complaints</span>
                    <a href="#" class="notification">
                    <span class="badge">
                        <?php 
                            if(is_array($fetchAssigned)) {
                                $number = count($fetchAssigned);
                                echo $number;
                                } else {
                                echo 0;
                                }
                        ?>
                    </span>
                    </a>
                </div>

                <div class="activity-data">
                    <table>
                        <thead>
                            <tr>
                                <td>
                                    <div class="data st">
                                        <span >COMPLAINT ID</span>
                                    </div>
                                    
                                </td>
                                <td>
                                    <div class="data st">
                                        <span >DEPARTMENT</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="data st">
                                        <span >LOCATION</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="data st">
                                        <span >DURATION</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="data st">
                                        <span >Expert Assigned</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="data st">
                                        <span >Mark Done</span>
                                    </div>
                                </td>
                                
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if(is_array($fetchAssigned)){      
                            $sn=1;
                            foreach($fetchAssigned as $data){
                            ?>
                            <tr >
                            <td><?php echo $data['ComplaintId']??''; ?></td>
                            <td><?php echo $data['Department']??''; ?></td>
                            <td><?php echo $data['Location']??''; ?></td>
                            <td><?php echo convertToRelativeTime($data['Timestart']); ?></td>
                            <td><?php echo $data['Expert_assigned']??''; ?></td>
                            <td>
                                <form action="developer.php" method="post">
                                <!-- <input type="text" style="display: none;" id="issue" name="issue" value=<?php echo $data['ComplaintId']; ?>>
                                    <label for="expert">Assign Expert:</label>
                                     <select id="expert" name="expert">
                                        <option value="">Select an expert</option>
                                        <?php foreach ($experts as $expert): ?>
                                        <option value = <?php echo $expert['Name']; ?>>
                                            <?php echo $expert['Name']; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select> 
                                    <input type="submit" value="Assign" >
                                </form> -->
                            </td>
                            </tr>
                            <?php
                            $sn++;}}else{ ?>
                            <tr>
                                <td colspan="8">
                            <?php echo $fetchAssigned; ?>
                            </td>
                            <tr>
                            <?php
                            }
                            ?>
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <?php
    // pending_comp.php

    if (isset($_GET['error'])) {
        $error = $_GET['error'];
        // Display the error message
        echo "<script>alert('$error');</script>";
    }
    ?>


    <script src="script.js"></script>
</body>
</html>