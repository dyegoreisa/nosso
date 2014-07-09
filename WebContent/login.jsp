<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<html lang="pt-br">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>.:: Autenticação ::.</title>
</head>
<body>
	<form method="POST"
		action="<%=response.encodeURL("j_security_check")%>">
		<fieldset title="Informe login e senha">
			<legend>Login</legend>

			<label for="j_username">Login:</label> <input type="text"
				name="j_username" class="textBox" /><br /> <label for="j_password">Senha:</label>
			<input type="password" name="j_password" class="textBox" /><br />

		</fieldset>
		<p align="center">
			<input type="submit" value="Login" />
		</p>
	</form>
</body>
</html>