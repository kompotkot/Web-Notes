<h3><?php if(isset($text)){echo $text;}?></h3>
<br>
<form method="post">
	<input type="text" name="email" placeholder="Введите email" required>
	<input type="password" name="password" placeholder="Введите пароль" required>
	<input type="submit" name="button" value="Войти">
</form>