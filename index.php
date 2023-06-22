<?php 
    include("database.php");
    $username = "Joseph 3";
    $pass = "Joseph900";
    $hash = password_hash($pass, PASSWORD_DEFAULT);
    // $sql = "INSERT INTO users (username, password) VALUES('$username', '$hash')";
    /*$sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);
    echo "--------------------------------------------<br>";
    if(mysqli_num_rows($result)> 0){
        while($row = mysqli_fetch_assoc($result)){
            echo "Id: ".$row['id'] . "<br>";
            echo "Username: ".$row['username'] . "<br>";
            echo "Created At: ".$row['createdAt'];
            echo "<br>--------------------------------------------<br>";
        };
        
    }
    mysqli_close($conn);*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action=<?php htmlspecialchars($_SERVER["PHP_SELF"])?>>
        <h2>Welcome to our Register Page</h2>
        <label for="">Username: </label>
        <input type="text" name="username" placeholder="Enter your name">
        <br><br>
        <label for="">Password: </label>
        <input type="password" name="password" placeholder="Enter your password">
        <br><br>
        <input type="submit" name="submit" value="Submit">
    </form>
    
</body>
</html>
<?php
    // $name = "Joseph";
    // $age = 10;
    // $age = $age + 15;
    // echo "Hello {$name}, you are {$age} years old";
    // echo $_POST['password'] . "<br>";
    // echo "{$_POST["username"]}";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $pass = $_POST['password'];
        $username = $_POST['username'];
        if(empty($username)){
            echo "Username is required";
        }
        elseif(empty($pass)){
            echo "Password is required";
        }
        else{
            //register user
            /*$hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username, password) VALUES('$username', '$hash')";
            
            try {
                $result = mysqli_query($conn, $sql);
                echo "You are now registered";
            } catch (\Throwable $th) {
                echo "Invalid data entry";
            }*/

            //Login user
            /*$sql = "SELECT * FROM users WHERE username = '$username'";
            $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)> 0){
                $row = mysqli_fetch_assoc($result);
                $hash = $row['password'];
                if(password_verify($pass, $hash)){
                    echo "You are now logged in";
                }
                else{
                    echo "Invalid password";
                }
            }
            else {
                echo "User does not exist";
            }*/
        }
        
    }
    
    mysqli_close($conn);
    
?>
 
 <!-- Creating class in PHP -->
<?php 
    /*class Person{
        var $name;
        var $age;
        var $gender;
    }

    $person1 = new Person();
    $person1->name = "Joseph";
    $person1->age = 24;
    $person1->gender = 'male';
    $person2 = new Person();
    $person2->name = "Mercy";
    $person2->age = 23;
    $person2->gender = 'Female';
    echo "<br>" . "$person1->age";
    echo "<br>" . "$person2->age";*/
?>