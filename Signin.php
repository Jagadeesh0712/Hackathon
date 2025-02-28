<?php
session_start();
// Validate and sanitize user input
$Username = isset($_POST['Username']) ? htmlspecialchars($_POST['Username']) : '';
// $Email = isset($_POST['Email']) ? filter_var($_POST['Email'], FILTER_SANITIZE_EMAIL) : '';
$Password = isset($_POST['Password']) ? $_POST['Password'] : '';

// Validate email format
// if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
//     echo "Invalid email address.";
//     exit;
// }

// Database connection
$conn = new mysqli('localhost', 'root', '', 'test');

// if(isset($_POST['Username']) && isset($_POST['Password']))
// {
//     function validate($data)
//     {
//         $data = trim($data);
//         $data = stripslashes($data);
//         $data = htmlspecialchars($data);
//         return $data;
//     }
// }

// $Username = validate($_POST['Username']);
// $Password = validate($_POST['Password']);


$query = "select * from registration where Username = '$Username' and Password = '$Password'";

$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) == 1)
{
    $row = mysqli_fetch_assoc($result);
    if($row['Username'] === $Username && $row['password'] == $Password)
    {
        $_SESSION['$Username'] = $row['Username'];
        $_SESSION['$Password'] = $row['Password'];
        // echo"LOGGED IN!";
        header("Location: firstpg.html");
        exit();
    }
   else{
        header("Location : Signup.html?");
        exit();
    }
}

else{
    header("location: index.html");
    exit();
}


?>