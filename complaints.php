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
    <style>
    .asc::after {
        content: " ▲";
    }

    .desc::after {
        content: " ▼";
    }
</style>
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
                <li><a href="#">
                    <i class="uil uil-files-landscapes"></i>
                    <span class="link-name">Complaints</span>
                </a></li>
                <li><a href="solved_comp.php">
                            <i class="uil uil-files-landscapes"></i>
                            <span class="link-name">solved complaints</span>
                        </a></li>
                <li><a href="pending_comp.php">
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
                    <span class="text">Complaints</span>
                </div>

                <div class="activity-data">
                    <table id="myTable">
                        <thead>
                            <tr>
                                <td onclick="sortTable(0)">
                                    <div class="data st">
                                        <span >COMPLAINT ID</span>
                                    </div>
                                    
                                </td>
                                <td onclick="sortTable(1)">
                                    <div class="data st">
                                        <span >DEPARTMENT</span>
                                    </div>
                                </td>
                                <td onclick="sortTable(3)">
                                    <div class="data st">
                                        <span >LOCATION</span>
                                    </div>
                                </td>
                                <td onclick="sortTable(2)">
                                    <div class="data st">
                                        <span >DURATION</span>
                                    </div>
                                </td>
                                <td onclick="sortTable(4)">
                                    <div class="data st">
                                        <span >STATUS</span>
                                    </div>
                                </td>
                                <td onclick="sortTable(5)">
                                    <div class="data st">
                                        <span >Expert Assigned</span>
                                    </div>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if(is_array($fetchAll)){      
                            $sn=1;
                            foreach($fetchAll as $data){
                            ?>
                            <tr class="clickable-row" data-description="<?php echo $data['Description'] ?? ''; ?>">
                            <td><?php echo $data['ComplaintId']??''; ?></td>
                            <td><?php echo $data['Department']??''; ?></td>
                            <td><?php echo $data['Location']??''; ?></td>
                            <td><?php echo convertToRelativeTime($data['Timestart']); ?></td>
                            <td><?php echo $data['Status']??''; ?></td>
                            <td><?php echo $data['Expert_assigned']??''; ?></td>
                            </tr>
                            <?php
                            $sn++;}}else{ ?>
                            <tr>
                                <td colspan="8">
                            <?php echo $fetchAll; ?>
                            </td>
                            <tr>
                            <?php
                            }?>
                            </tbody>
                    </table>
                </div>
            </div>
            <div class="modal" id="descriptionModal" tabindex="-1" role="dialog" aria-labelledby="descriptionModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="descriptionModalLabel">Description of the complaint</h5>
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
    </section>

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

    <script>
    function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("myTable");
    switching = true;
    // Set the sorting direction to ascending
    dir = "asc";
    while (switching) {
        switching = false;
        rows = table.getElementsByTagName("TR");
        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount++;
        } else {
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
    
    // Update the table headers to show sorting order
    var headers = table.getElementsByTagName("TH");
    for (var i = 0; i < headers.length; i++) {
        headers[i].innerHTML = headers[i].innerHTML.replace(" ▲", "").replace(" ▼", "");
        headers[i].classList.remove("asc", "desc");
    }
    headers[n].classList.add(dir);
    headers[n].innerHTML += (dir === "asc") ? " ▲" : " ▼";
}
</script>




    <script src="script.js"></script>
</body>
</html>