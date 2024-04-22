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
							<a class="header__navigation-list-item-link" href="#">Каталог</a>
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
						<h2 class="Catalog-title">Каталог товаров</h2>
						<div class="main__catalog-list">
							<a href="BrushesPageList.php" class="main__catalog-list-item-link" style="background-image: url('images/CatalogItem1.png');">
								<h3 class="main__catalog-list-item-text">Кисти</h3>
							</a>
							<a href="PencilsPageList.php" class="main__catalog-list-item-link" style="background-image: url('images/Pencils.png');">
								<h3 class="main__catalog-list-item-text">Карандаши</h3>
							</a>
							<a href="PaintsPageList.php" class="main__catalog-list-item-link" style="background-image: url('images/Paints.png');">
								<h3 class="main__catalog-list-item-text">Краски</h3>
							</a>
						</div>
					</div>
				</div>
			</section>
		</div>
	</main>
</body>
</html>