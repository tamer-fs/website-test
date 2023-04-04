<?php
include("../html/header.html");
include("index.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="verify.php">
        <input type="text" name="verify_input">
        <input type="submit" name="submit_verify">
    </form>
</body>

</html>

<?php
/*
try {

    mysqli_query($conn, $sql_query);
    echo '<script type="text/javascript">username_free();</script>';
    echo '<script type="text/javascript">change_page("verify.php");</script>';

} 
catch (mysqli_sql_exception) {
                
    echo '<script type="text/javascript">username_taken();</script>';
}

*/

?>

<?php
include("../html/footer.html");

?>