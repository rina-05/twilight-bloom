<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "twilight_bloom_db";

//create conection to db
$conn = new mysqli($servername, $username, $password, $dbname);

//check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);

}

//if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //collect form data
    $user_input_username = $_POST['username'] ?? '';
    $user_input_email = $_POST['email'] ?? '';
    $user_input_password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']) ? true : false;

    //input fields
    if (empty($user_input_username) || empty($user_input_email) || empty($user_input_password)) {
        echo "Please fill in all fields.";
        exit;
    }

    //sql query to search for user
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $user_input_username, $user_input_email);
    $stmt->execute();
    $result = $stmt->get_result();

    //check if user exists
    if ($result->num_rows > 0) {
        //get user data
        $user = $result->fetch_assoc();

        //varify pass
        if (password_verify($user_input_password, $user['password'])) {
            //set session/cookie to rmb user
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $user['username'];

            if ($remember) {
                //cookie to rmb user eg 30days
                setcookie('username', $user['username'], time() + (30 * 24 * 60 * 60), "/"); // Remember for 30 days
            }

            // redirect to dashboard eg
            header("Location: dashboard.php");
            exit;
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }
} else {
    echo "No form submitted.";
}

//close db connection
$conn->close();
?>