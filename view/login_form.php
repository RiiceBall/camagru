<html>
<head>
	<meta charset="UTF-8">
</head>
<body>
	<div id="formule">
		<div id="sform">
			<label for="suname">Username: </label>
			<input type="text" name="suname" id="suname" maxlength="15">
			<br>
			<label for="spasswd">Password: </label>
			<input type="password" name="spasswd" id="spasswd" maxlength="16">
			<br>
			<input type="submit" name="submit" onclick="request_sign_in(check_sign_in);" value="sign_in">
			<input type="button" onclick="location.href='<?= $path_forgot ?>'" value="Forgot Password">
			<p id="error_sign_in" class="error_message"></p>
		</div>
		<hr>
		<div id="rform">
			<label for="runame">Username: </label>
			<input type="text" name="runame" id="runame" maxlength="15">
			<br>
			<label for="rpasswd">Password: </label>
			<input type="password" name="rpasswd" id="rpasswd" maxlength="16">
			<br>
			<label for="rpasswd2">Confirm Password: </label>
			<input type="password" name="rpasswd2" id="rpasswd2" maxlength="16">
			<br>
			<label for="email">E-mail: </label>
			<input type="email" name="email" id="email">
			<br>
			<input type="submit" name="submit" onclick="request_register(check_register);" value="register">
			<p id="error_register" class="error_message"></p>
		</div>
	</div>
	<script type="text/javascript" src="public/js/user.js"></script>
</body>
</html>
