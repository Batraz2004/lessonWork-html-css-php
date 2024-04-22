<?php
session_start();
$link=mysqli_connect('localhost','root','','MyWorkDB');

$UserGoodID='';
if(array_key_exists('goodsId', $_POST))
$UserGoodID=$_POST['goodsId'];
$rows=[];
if(count($_SESSION)>0&&array_key_exists('id', $_SESSION))
{
	$userID=$_SESSION['id'];
	$res=mysqli_query($link,"SELECT * FROM UsersGoods JOIN Goods ON UsersGoods.goodsID=Goods.id WHERE usersID='$userID'");
	$rows=mysqli_fetch_all($res,MYSQLI_ASSOC);

	if(count($_POST)>0&&array_key_exists('goodsId',$_POST))
	{
		$query=mysqli_query($link,"DELETE FROM UsersGoods WHERE Id ='$UserGoodID'");
		$link->query($query);
		header("Location: http:personal.php");
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
							<a class="header__navigation-list-item-link" href="Authorization.php">Регистрация/Авторизация</a>
						</li>
						<li class="header__navigation-list-item">
							<a class="header__navigation-list-item-link" href="catalog.php">Каталог</a>
						</li>
						<li class="header__navigation-list-item">
							<a class="header__navigation-list-item-link" href="#">Личный кабинет</a>
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
						<h2 class="Catalog-title">Мои товары</h2>
						<div class="main__catalog-content">
							<?php
							foreach($rows as $value)
							{?>
								<Form class="Product" name="Product-form" method="POST">
									<ul class="Product__list">
										<li class="Product__list-item Product__image"><img src="<?=$value['image_src']?>" alt="PencilImage"></li>
										<li class="Product__list-item Product__price"><p>Цена:<?=$value['price']?></p></li>
										<li class="Product__list-item Product__name"><p><?=$value['name']?></p></li>
									</ul>
									<input type="hidden" name="goodsId" value="<?=$value['Id']?>">
									<button type="submit" class="Catalog__button" name="value-id" value=""><p>Удалить</p></button>
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