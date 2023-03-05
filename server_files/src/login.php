<?php
    //Start session
    require './config.php';

    //If someone is already logged in, log them out and try login flow
    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {

    }

    if(isset($_GET['user']) && isset($_GET['pass'])) {
        //Query Database for user
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if($mysqli->connect_errno) {
            echo $mysqli->connect_error; //TODO replace echo with logging 
            exit();
        }

        //SQL query
        $stmt = $conn->prepare("SELECT username, password, salt FROM users
                                WHERE username = ?");
        $stmt->bind_param("s", $_GET['user']);
        $exec = $stmt->execute();
        if(!$executed_registered) {
            echo $mysqli->error; //TODO replace echo with logging 
        }

        //Getting number of results with prepared statements
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $num_valid = 0;
        foreach ($data as &$value) {
            if(!$value[closed]) {
                $num_valid += 1;
                $user = $value;
            }
        }
        if($num_valid == 0) {
            echo "Can't find user: " + $_GET['user']; //TODO: Replace with logging
        }
        if($num_valid > 1) {
            echo "Multiple users with same username"; //TODO: Replace with logging
        }

        $statement_registered->close();

        //TODO: PASSWORD SALTING AND HASHING HERE $user should contain user information

        
        

        // Set session information
        $_SESSION["logged_in"] = true;
        $_SESSION["username"] = $user["username"];

    }
    else {
        $error = "Missing Username or Password"
    }

?>

<?php
    if ( isset($error) && !empty($error) ) {
        echo $error;
    }
    else {
        echo "Successful login!";
    }
?>