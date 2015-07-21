<?php
	require_once 'resources/dbconfig.php'
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
</head>
<body>
<center><h1>Registrér spiller til ØL</h1>
<form action="resources/functions/register_user.php" method="POST">
Navn: <input type="text" name="username">
<br>
Kodeord: <input type="text" name="password">
<br>
Email: <input type="text" name="email">
<br><br>
<input type="submit" value="Registrér">
</form>
</center>
</body>
</html>