<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Execute Command</title>
</head>
<body>

<form action="./test.php" method="post">
    <button type="submit" name="executeBtn">Execute Command</button>
</form>

<?php
if(isset($_POST['executeBtn'])){
    //shell_exec('php /var/www/html/run_motor.php');
	//exec('lxterminal -e php /var/www/html/run_motor.php');
	//exec('sudo php /var/www/html/run_motor.php');
    exec("sudo python3 /var/www/html/steppermotor.py");

    //php run_motor.php
    //php /var/www/html/run_motor.php
}
?>



</body>
</html>
