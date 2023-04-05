<?php
session_start();
include("../html/header.html");
include("database.php");
?>

<style>
    section {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        width: 500px;
        margin: auto;
        margin-top: 200px;
        height: 300px;
        position: relative;
        background-color: #040F0F;
        padding: 20px;
        border-radius: 10px;
    }

    #text-input {
        flex: 1 0 130px;
        padding: 0px 10px;
        border-radius: 5px;
        background-color: #2E2F2F;
        border: 1px solid white;
        color: white;
        height: 40px;
    }

    #password-toggle {
        flex: 1 0 130px;
        padding: 0px 10px;
        border-radius: 5px;
        background-color: #2E2F2F;
        border: 1px solid white;
        color: white;
        height: 40px;
        margin-bottom: 250px;
    }

    #toggle-image {
        width: 30px;
        height: auto;
        position: absolute;
        top: 7.5%;
        left: 370px;
        transition: .5s ease;
        cursor: pointer;
    }

    #submit-btn {
        flex: 1 0 40px;
        background-color: #677DB7;
        border: none;
        border-radius: 5px;
        color: white;
        height: 40px;
        transition: .3s ease;
        cursor: pointer;
    }

    #submit-btn:hover {
        color: black;
        background-color: white;
        transition: .3s ease;
    }

    .text {
        position: absolute;
        bottom: 55px;
        text-align: center;
        width: 100%;
        left: 0px;
    }

    .text>h2 {
        color: white;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        font-weight: lighter;
    }

    .text>p {
        color: white;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        font-weight: lighter;
        padding: 0px 20px;
    }

    .text>a {
        color: white;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        font-weight: lighter;
        padding: 0px 20px;
    }

    .reject-match-div {
        display: none;
        width: 500px;
        margin: auto;
        margin-top: 50px;
        background-color: #040F0F;
        color: red;
        padding: 20px;
        border-radius: 10px;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        font-weight: lighter;
    }
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/toggleVisability.js"></script>
    <title>Document</title>
    <script type="text/javascript">
        function reject_login() {
            var element = document.getElementById("rejected-match");
            element.style.display = "block";
        }

        function email_not_found() {
            var element = document.getElementById("rejected-email");
            element.style.display = "block";
        }

        function email_found() {
            var element = document.getElementById("rejected-email");
            element.style.display = "none";
        }

        function accept_login() {
            var element = document.getElementById("rejected-match");
            element.style.display = "none";
        }

        function change_page(page) {
            window.location = page;
        }
    </script>
</head>

<body>
    <form action="login.php" method="post">
        <section>
            <div class="text">
                <h2>Log in</h2> <br>
                <p>
                    You can log in here in your already existing account, if you dont have an account yet
                    <a href="index.php" style="color: white;">sign in here</a>
                </p> <br>
                <a href="#">read more</a> <br> <br> <br>
            </div>
            <input type="text" placeholder="Email" name="email" id="text-input" required>
            <input type="password" placeholder="Password" name="pass" id="password-toggle" required>
            <img src="../assets/images/visibility_on.png" alt="toggle visibility" id="toggle-image" onclick="toggle()">
            <input type="submit" name="login" value="Log in" id="submit-btn">
        </section>
        <div class="reject-match-div" id="rejected-match">
            <p>The email address and password dont match.</p>
        </div>
        <div class="reject-match-div" id="rejected-email">
            <p>There doesn't exist an account on this email address, try signing in first.</p>
        </div>
    </form>


</body>

</html>
<?php
include('../html/footer.html');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $email = $_POST["email"];
    $pass  = $_POST["pass"];
    $sql_email_check = "SELECT email FROM users WHERE email = '{$email}'";
    $email_check_result = mysqli_query($conn, $sql_email_check);
    if (mysqli_num_rows($email_check_result) == 1) {
        echo '<script type="text/javascript">email_found();</script>';
        if (!empty($email) && !empty($pass)) {
            $sql_query = "SELECT password, user FROM users WHERE email='{$email}'";
            $query = mysqli_query($conn, $sql_query);
            $value = mysqli_fetch_row($query);
            if (password_verify($pass, $value[0])) {
                $_SESSION["username"] = $value[1];
                $_SESSION['email'] = $email;
                $_SESSION["logged_in"] = true;
                $username = $email;
                $find_id_query = "SELECT id FROM users WHERE email = '{$username}'";
                $id_result = mysqli_query($conn, $find_id_query);
                $id = mysqli_fetch_row($id_result);
                $_SESSION["id"] = $id;
                echo '<script type="text/javascript">accept_login();</script>';
                echo '<script type="text/javascript">change_page("home.php");</script>';
            } else {
                echo '<script type="text/javascript">reject_login();</script>';
            }
        }
    } else {
        echo '<script type="text/javascript">email_not_found();</script>';
    }
}
?>