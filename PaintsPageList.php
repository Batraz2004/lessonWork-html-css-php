<?php
session_start();
$link=mysqli_connect('localhost','root','','MyWorkDB');
$res=mysqli_query($link,"SELECT * FROM Goods WHERE Type='Paint'");
$rows=mysqli_fetch_all($res,MYSQLI_ASSOC);

//значения из формы :
$goodsID='';$goodsName='';
if(array_key_exists('goodsId', $_POST))
$goodsID=$_POST['goodsId'];
if(array_key_exists('goodsName', $_POST))
$goodsName=$_POST['goodsName'];
if(array_key_exists('id', $_SESSION))
$userID=$_SESSION['id'];

if(array_key_exists('Auth',$_SESSION)&&$_SESSION['Auth']==true)
{
	if(count($_POST)>0&&array_key_exists('goodsId',$_POST))
	{
		$query="INSERT INTO `UsersGoods` (name,usersID,goodsID) Values('$goodsName','$userID','$goodsID')";
		$link->query($query);
	}
}
else
{
	header("Location: http:Authorization.php");
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
							<a class="header__navigation-list-item-link" href="Authorization.php">Регистрация/Авторизация</a>
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
			<section class="main__catalog">
				<div class="container">
					<div class="main__catalog-wrapper">
						<div class="main__catalog-content">
						<h3 class="main__catalog-content-title"> </h3>
							<?php
							foreach($rows as $value)
							{?>
								<Form class="Product" name="Product-form" method="POST">
									<ul class="Product__list">
										<li class="Product__list-item Product__image"><img src="<?=$value['image_src']?>" alt="PencilImage"></li>
										<li class="Product__list-item Product__price"><p>Цена:<?=$value['price']?></p></li>
										<li class="Product__list-item Product__name"><p><?=$value['name']?></p></li>
									</ul>
									<input type="hidden" name="goodsId" value="<?=$value['id']?>">
									<input type="hidden" name="goodsName" value="<?=$value['name']?>">
									<button type="submit" class="Catalog__button" name="value-id" value=""><p>Добавить в корзину</p></button>
								</Form>
							<?php
							}?>
						</div>
					</div>
				</div>
			</section>
		</div>
	</main>
</body>
</html>