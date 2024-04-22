<?php
session_start();

$link=mysqli_connect('localhost','root','','MyWorkDB');

$message='';$name_message='';$pass_message='';$email_message='';//сообщения для инпутов
//значения из формы :
$name='';$pass='';$mail='';

$errors=[];//массив ошибок

if(array_key_exists('name', $_POST))
$name=$_POST['name'];
if(array_key_exists('pass', $_POST))
$pass=$_POST['pass'];
if(array_key_exists('e-mail', $_POST))
{$mail=$_POST['e-mail'];}


$res=mysqli_query($link,"SELECT * FROM `Users` ");
$rows=mysqli_fetch_all($res,MYSQLI_ASSOC);
$authQuery=mysqli_query($link,"SELECT * FROM Users WHERE name='$name' and  password ='$pass' and  `e-mail` ='$mail'");//проверим существует ли данный пользоватль 
$EmailQuery=mysqli_query($link,"SELECT * FROM Users WHERE `e-mail` ='$mail'");//проверим существует ли данный пользоватль 
$row = mysqli_fetch_assoc($authQuery);//полученные данные пользователя из таблицы

//вход
if(isset($_POST['authButton']))
{  
	if($row)
	{
		$_SESSION['e-mail']=$mail;
		$_SESSION['name']=$name;
		$_SESSION['password']=$pass;
		$_SESSION['id']=$row['id'];
		$_SESSION['Auth']=true;
		header("Location: http:index.php");
	}
	else
	$message='не удалось войти';
}

//регистрация
if(isset($_POST['regButton']))
{
	if(mysqli_fetch_assoc($EmailQuery))
	{
		$email_message='Такое e-mail уже существует!';
		array_push($errors,$email_message);
	}
	else
	{
		if(strlen($name)<2)
		{
			$name_message='слишком короткое имя';
			array_push($errors,$name_message);
		}
		if(strlen($pass)<5)
		{
			$pass_message='слишком короткий пароль';
			array_push($errors,$pass_message);
		}
		if(!filter_var($mail, FILTER_VALIDATE_EMAIL))
		{
			$email_message='Не коректный email';
			array_push($errors,$email_message);
		}

		if(count($errors)==0)
		{
		    $query="INSERT INTO Users (`e-mail`,name,password) Values ('$mail','$name','$pass')";
		    
		    if($link->query($query))
		    {
		    	$authQuery=mysqli_query($link,"SELECT * FROM Users WHERE name='$name' and  password ='$pass' and  `e-mail` ='$mail'");
		    	$row = mysqli_fetch_assoc($authQuery);
		    	$_SESSION['e-mail']=$mail;
		    	$_SESSION['name']=$name;
				$_SESSION['password']=$pass;
				$_SESSION['id']=$row['id'];
				$_SESSION['Auth']=true;
				header("Location: http:index.php");
			}
			else
			$message="Произошла ошибка".mysqli_errno($link) . ": " . mysqli_error($link). "\n";
		}
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
	<header>
		<div class="header__wrapper">
			<div class="container">
				<div class="header__navigation">
					<div class="header__logo"><p>Chopoko</p></div>
					<ul class="header__navigation-list">
						<li class="header__navigation-list-item">
							<a class="header__navigation-list-item-link" href="index.php">Главная</a>
						</li>
						<li class="header__navigation-list-item">
							<a class="header__navigation-list-item-link" href="#">Регистрация/Авторизация</a>
						</li>
						<li class="header__navigation-list-item">
							<a class="header__navigation-list-item-link" href="catalog.php">Каталог</a>
						</li>
						<li class="header__navigation-list-item">
							<a class="header__navigation-list-item-link" href="personal.php">Личный кабинет</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</header>
	<main>
		<div class="main__wrapper">
			<div class="container">
				<form class="personal-account__form" method="POST" action="">
					<label class="personal-account__form-label">
						<input type="text" name='e-mail' placeholder="e-mail">
						<p class="message"><?=$email_message?></p>
						<input type="text" name="name" placeholder="имя">
						<p class="message"><?=$name_message?></p>
						<input type="password" name='pass' placeholder="пароль">
						<p class="message"><?=$pass_message?></p>
						<label class="personal-account__form-label-buttons">
							<button type="submit" class="personal-account_profile_save-button" name='authButton'>
									<p>Войти</p>
							</button>
							<button type="submit" class="personal-account_profile_save-button" name='regButton'>
									<p>Регистрация</p>
							</button>
							
						</label>
						<p class="message"><?=$message?></p>
					</label>
				</form>
			</div>
		</div>
	</main>
</body>
</html>