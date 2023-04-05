<?php
session_start();
include("../html/header.html");
include("database.php");
$user_feedback = "";
?>

<style>
    section {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        width: 500px;
        margin: auto;
        margin-top: 200px;
        height: 350px;
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
        top: 20.5%;
        left: 270px;
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

    .reject-password-div {
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

    .reject-username-div {
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
        function reject_password() {
            var element = document.getElementById("rejected-password");
            element.style.display = "block";
        }

        function username_taken() {
            var element = document.getElementById("rejected-username");
            element.style.display = "block";
        }

        function username_free() {
            var element = document.getElementById("rejected-username");
            element.style.display = "none";
        }

        function accept_password() {
            var element = document.getElementById("rejected-password");
            element.style.display = "none";
        }

        function change_page(page) {
            window.location = page;
        }
    </script>
</head>

<body>
    <form action="index.php" method="post">
        <section>
            <div class="text">
                <h2>Sign in</h2> <br>
                <p>
                    To track your orders and get discounts up to 40% with your orders, sign up here.
                    If you're signed up you will get one random free item in your order. If you already have an account:
                    <a href="login.php" style="color: white;">log in here</a>
                </p> <br>
                <a href="#">read more</a> <br> <br> <br>
                <a href="home.php">skip sign in</a>
            </div>
            <input type="text" placeholder="Name" name="user" id="text-input" required>
            <input type="text" placeholder="Email" name="email" id="text-input" required>
            <input type="password" placeholder="Password" name="pass" id="password-toggle" required>
            <img src="../assets/images/visibility_on.png" alt="toggle visibility" id="toggle-image" onclick="toggle()">
            <input type="submit" name="register" value="sign in" id="submit-btn">
        </section>

        <div class="reject-password-div" id="rejected-password">
            <p> Password should be at least 8 characters in length and should include at least one
                upper case letter, one number, and one special character </p>
        </div>

        <div class="reject-username-div" id="rejected-username">
            <p> Looks like you already have an account on this email address. </p>
        </div>
    </form>


</body>

</html>
<?php
include('../html/footer.html');
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["register"])) {

        $username = filter_input(INPUT_POST, "user", FILTER_SANITIZE_SPECIAL_CHARS);
        $pass = filter_input(INPUT_POST, "pass", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $verify_code = rand(100000, 999999);
        $uppercase = preg_match('@[A-Z]@', $pass);
        $lowercase = preg_match('@[a-z]@', $pass);
        $number = preg_match('@[0-9]@', $pass);
        $special_chars = preg_match('@[^\w]@', $pass);
        $user_feedback = "";
        $email_valid = null;
        $check_name_query = "SELECT * FROM users WHERE email = '{$email}'";
        $email_result = mysqli_query($conn, $check_name_query);

        if (!empty($username) && !empty($pass) && !empty($email)) {

            if (!$uppercase || !$lowercase || !$number || !$special_chars) {

                $user_feedback = "Password should be at least 8 characters in length and should include at least one 
                                  upper case letter, one number, and one special character";

                echo '<script type="text/javascript">reject_password();</script>';
            } else {

                $hash = password_hash($pass, PASSWORD_DEFAULT);
                $user_feedback = "Good password";

                if (mysqli_num_rows($email_result) > 0) {
                    $email_valid = false;
                    echo '<script type="text/javascript">username_taken();</script>';
                } else {
                    $email_valid = true;
                    echo '<script type="text/javascript">username_free();</script>';
                    $sql_query = "INSERT INTO users (user, password, email) VALUES ('$username', '$hash', '$email')";
                    echo '<script type="text/javascript">accept_password();</script>';

                    try {
                        mysqli_query($conn, $sql_query);
                        $_SESSION["username"] = $username;
                        $_SESSION["logged_in"] = true;
                        $username = $email;
                        $find_id_query = "SELECT id FROM users WHERE email = '{$username}'";
                        $id_result = mysqli_query($conn, $find_id_query);
                        $id = mysqli_fetch_row($id_result);
                        echo '<script type="text/javascript">username_free();</script>';
                        echo '<script type="text/javascript">change_page("home.php");</script>';
                    } catch (mysqli_sql_exception) {

                        echo '<script type="text/javascript">username_taken();</script>';
                    }
                }
            }
        }
    }
    mysqli_close($conn);
}
?>