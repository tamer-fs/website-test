<?php
include("../html/header.html");
session_start();

if ($_SESSION['logged_in']) {
    $username = $_SESSION["username"];
} else {
    $username = "";
}
?>

<style>
    .top-line {
        display: flex;
        height: 130px;
        align-items: center;
    }

    .top-line .input-sect>input {
        width: 550px;
        height: 50px;
        border-radius: 25px;
        margin: auto;
        border: 1px solid black;
        padding: 10px;
        margin-right: 0px;
        margin-right: 30px;
    }

    .top-line>.input-sect {
        justify-items: center;
        display: flex;
        margin: auto;
    }

    .top-line>h1 {
        margin-left: 15px;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        font-weight: 300;
        font-size: 1.8rem;
    }

    .search-icon {
        border-radius: 30px;
        width: 40px;
        height: 40px;
        padding: 5px;
        border: 1px solid black;
        cursor: pointer;
        transition: .5s ease;
    }

    .search-icon:hover {
        rotate: 90deg;
        transition: .5s ease;
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
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript">
    </script>
</head>

<body>
    <a href="#" class="hover-underline-animation" id="account-link"><?php echo $_SESSION["username"]; ?></a>
    <section class="top-line">
        <div class="input-sect">
            <input type="text" placeholder="What are you looking for?">
            <img class="search-icon" src="../assets/images/searchicon.png" alt="">
        </div>
    </section>
</body>

</html>

<?php
include("../html/footer.html");
?>