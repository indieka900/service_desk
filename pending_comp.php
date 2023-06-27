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

    <title>SERVICE DESK</title> 
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="images/logo.png" alt="">
            </div>

            <span class="logo_name">SERVICE DESK</span>
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
                            <tr class="clickable-row" data-description="<?php echo $data['Description'] ?? ''; ?>">
                            <td><?php echo $data['ComplaintId']??''; ?></td>
                            <td><?php echo $data['Department']??''; ?></td>
                            <td><?php echo $data['Location']??''; ?></td>
                            <td><?php echo convertToRelativeTime($data['Timestart']); ?></td>
                            <td>
                                <form action="developer.php" method="post">
                                <input type="text" style="display: none;" id="issue" name="issue" value=<?php echo $data['ComplaintId']; ?>>
                                    <select id="expert" name="expert">
                                        <option value="">Select an expert</option>
                                        <?php foreach ($experts as $expert): ?>
                                        <option value = <?php echo $expert['Name']; ?>>
                                            <?php echo $expert['Name']; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <button type="submit">Assign</button>
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
                            <tr class="clickable-row" data-description="<?php echo $data['Description'] ?? ''; ?>">
                            <td><?php echo $data['ComplaintId']??''; ?></td>
                            <td><?php echo $data['Department']??''; ?></td>
                            <td><?php echo $data['Location']??''; ?></td>
                            <td><?php echo convertToRelativeTime($data['Timestart']); ?></td>
                            <td><?php echo $data['Expert_assigned']??''; ?></td>
                            <td>
                            <form method="post" action="update_comp.php">
                                <input type="hidden" id="form2" name="form2" value=<?php echo $data['ComplaintId']; ?>>
                                <!-- form 2 fields go here -->
                                <button type="submit"><i class='uil uil-check'></i> Mark Done</button>
                            </form>
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
                <div class="modal" id="descriptionModal" tabindex="-1" role="dialog" aria-labelledby="descriptionModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="descriptionModalLabel">Description</h5>
                                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    </button> -->
                                </div>
                                <div class="modal-body">
                                    <p id="descriptionContent"></p>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        
    </section>
    <?php
        if (isset($_GET['error'])) {
            $error = $_GET['error'];
            // Display the error message
            echo "<script>alert('$error');</script>";
        }
    ?>
    <script>
    // Add event listener to the clickable rows
    const clickableRows = document.querySelectorAll('.clickable-row');
    clickableRows.forEach(row => {
        row.addEventListener('click', function() {
            // Retrieve the description from the data attribute
            const description = this.getAttribute('data-description');

            // Set the description content in the modal
            document.getElementById('descriptionContent').textContent = description;

            // Open the modal
            $('#descriptionModal').modal('show');
        });
    });
</script>

    <script src="script.js"></script>
</body>
</html>