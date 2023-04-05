<?php
session_start();
include("database.php");
include('../html/header.html');
?>

<style>
    .page-container {
        width: 80vw;
        margin: auto;
        padding: 50px 15px;
    }

    #logout-btn {
        background-color: #DC3131;
        color: white;
        padding: 10px;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        font-size: 1rem;
        border: none;
        border-radius: 5px;
    }

    #logout-btn:hover {
        cursor: pointer;
        margin-top: 2px;
    }

    #container {
        width: 50vw;
        text-align: left;
        margin: auto;
    }

    .widget {
        padding: 15px;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
        border-radius: 5px;
        margin: 15px 0px;
    }

    label {
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    }

    .text-input {
        width: 30vw;
        height: 40px;
        border-radius: 40px;
        border: 1px solid rgba(0, 0, 0, 0.2);
        margin-left: 30px;
        padding: 15px;
    }

    .submit-btn {
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        padding: 10px;
        font-size: 1rem;
        border: none;
        background-color: #677DB7;
        color: white;
        border-radius: 5px;
        float: right;
        cursor: pointer;
        transition: .5s ease;
        border: 1px solid white;
    }

    .submit-btn:hover {
        color: black;
        background-color: white;
        transition: .5s ease;
        border: 1px solid black;
    }

    .hover-underline-animation {
        display: inline-block;
        position: relative;
    }


    .hover-underline-animation:after {
        content: '';
        position: absolute;
        width: 100%;
        transform: scaleX(0);
        height: 1px;
        bottom: 0;
        left: 0;
        background-color: #677DB7;
        transform-origin: bottom right;
        transition: transform 0.25s ease-out;
    }

    .hover-underline-animation:hover:after {
        transform: scaleX(1);
        transform-origin: bottom left;
    }

    #account-link {
        text-decoration: none;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        color: white;
        position: absolute;
        top: 20px;
        left: 200px;
        padding-bottom: 5px;
    }

    @media (max-width: 1284px) {
        .text-input {
            width: 50%;
        }
    }

    @media (max-width: 955px) {
        #container {
            width: 80vw;
        }

        .widget {
            width: 80vw;
        }

    }
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        function change_page(page) {
            window.location = page;
        }

        function refresh_page() {
            document.location.reload();
        }
    </script>
</head>

<body>
    <a href="user.php" class="hover-underline-animation" id="account-link"><?php echo $_SESSION["username"]; ?></a>
    <section class="page-container" style="text-align: center;">
        <div id="container">
            <form action="user.php" method="get" style="justify-items: center;" class="widget">
                <label>change name:</label>
                <input type="text" class="text-input" name="change-name-input" required>
                <input type="submit" value="submit" name="name-change" class="submit-btn">
            </form>

            <form action="user.php" method="get" style="justify-items: center;" class="widget">
                <label>change name:</label>
                <input type="text" class="text-input">
                <input type="submit" value="submit" name="name-change" class="submit-btn">
            </form>

            <form action="user.php" method="get" style="justify-items: center;" class="widget">
                <label>change name:</label>
                <input type="text" class="text-input">
                <input type="submit" value="submit" name="name-change" class="submit-btn">
            </form>

            <form action="user.php" method="get">
                <input type="submit" value="log out" name="logout" id="logout-btn">
            </form>

        </div>
    </section>
</body>

</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['logout'])) {
        $_SESSION['logged_in'] = false;
        $_SESSION['username'] = "";
        echo "<script type='text/javascript'>change_page('login.php')</script>";
    }
    if (isset($_GET['name-change'])) {
        if (!empty($_GET['change-name-input'])) {
            $name = $_GET['change-name-input'];
            $id = $_SESSION['id'];
            $sql_query = "UPDATE users SET user = '{$name}' WHERE id = {$id[0]}";
            mysqli_query($conn, $sql_query);
            $_SESSION["username"] = $_GET["change-name-input"];
        }
    }
}
?>