<?
@session_start();
// var_dump($_SESSION); exit();
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Расширенная гарантия");

include_once($_SERVER["DOCUMENT_ROOT"] . "/php/models/spdo.class.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/php/models/product.class.php");




$model = new Core\prod();

$items = $model->getProdsByLogin( $_SESSION['user']['phone'] );
?>

<? if ( !isset($_SESSION["user"]["phone"]) ) { ?>

<div class="contacts-main">

	<div class="contacts-main-left">
		<h2>Справочная информация</h2>
		<span>
Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi voluptate beatae eaque consequuntur. Iusto, quisquam! Repellat debitis recusandae laborum, nihil eum explicabo ratione pariatur quos eos totam ad, magnam sunt.
Lorem ipsum, dolor sit amet consectetur adipisicing elit. Perspiciatis sequi doloribus facere id eligendi rem unde doloremque, ratione tenetur nisi, consequatur nostrum omnis eos soluta consectetur ullam alias, consequuntur eaque.<br><br>
</span>
                                                           

	</div>

	<!--form method="POST" action="/php/ajax/auth.php" class="contacts-main-right"-->
	<div class="contacts-main-right">
		<h2>Авторизация / Регистрация</h2>
		<!-- сделать маску для ввода номера -->
		<input class="contacts-main-input mb-input-warranty" type="email" name="email" id="mail" placeholder="Email">
		<input class="contacts-main-input mb-input-warranty" type="text" name="phone" id="phone" placeholder="Номер телефона">
		<input class="contacts-main-input mb-input-warranty" type="password" name="password"  id="code" placeholder="Пароль из SMS">
		<div class="contacts-main-notif dnone">Код отправлен на ваш телефон</div>
		<div class="contacts-main-btns">
			<button class="button wide dnone" type="submit" id="butAuth" onclick="customLogIn()">Войти</button>
			<div class="button wide sendcode" id="sendcode" onclick="customSendCode()">Отправить код</div>
		</div>
	</div>
	<!--/form-->

</div>
<div class="container">
	<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi voluptate beatae eaque consequuntur. Iusto, quisquam!
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi voluptate beatae eaque consequuntur. Iusto, quisquam! Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi voluptate beatae eaque consequuntur. Iusto, quisquam!
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi voluptate beatae eaque consequuntur. Iusto, quisquam!</p>

<h2>УСЛОВИЯ ОБСЛУЖИВАНИЯ</h2>
<ul><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi voluptate beatae:
<li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi voluptate beatae Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi voluptate beatae</li><br>
<li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi voluptate beatae</li><br>
<li>Lorem ipsum dolor sit amet consectetur adipisicing elit.</li><br>
<li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi voluptate beatae Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi voluptate beatae</li><br>
<li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi voluptate beatae</li><br>
<li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi voluptate beatae</li><br>
<li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi voluptate beatae</li><br>
<li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi voluptate beatae Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi voluptate beatae</li><br>
<li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi voluptate beatae Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi voluptate beatae Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi voluptate beatae</li><br>
<li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi voluptate beatae</li></p></ul>
</div>


<? } else { ?>

	<!--alert custom-->
	<div class="container-custom-alert dnone">
		<div class="container-custom-alert__text">
			Произошла непредвиденная ошибка!
		</div>
	</div>
	<!--alert custom-->
<!-- v else:start -->

<div class="banner-tip">
	<span>1. Рассмотрение заявки занимает от 1 часа до 3 рабочих дней</span>
	<span>2. Если товар куплен на Ozon или Wildberries - в поле "Название продукта" указывайте номер заказа на маркетплейсе</span>
	<span>3. Если ваша заявка была отклонена из-за пунтка 2 - то отправьте повторный запрос, указав номер заказа</span>
</div>

<div class="contacts-main warranty">

	<div class="warranty-left">
		<h2>Ваши продукты</h2>
		<div class="warranty-left-table">
			<table class="table">
				<thead class="warranty-left-table-head">
					<tr>
						<th class="warranty-left-table-head__item">Дата</th>
						<th class="warranty-left-table-head__item">Название</th>
						<th class="warranty-left-table-head__item">Чек</th>
						<th class="warranty-left-table-head__item">Паспорт</th>
						<th class="warranty-left-table-head__item">Комментарий</th>
						<th class="warranty-left-table-head__item">Статус</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($items as $key => $value) { ?>
					<?php 
					if ( file_exists($_SERVER['DOCUMENT_ROOT'] . "/upload/users/" . $_SESSION['user']['phone'] . "/" . $value['id'] . "_check.png") ) { $check = ".png"; } 
					if ( file_exists($_SERVER['DOCUMENT_ROOT'] . "/upload/users/" . $_SESSION['user']['phone'] . "/" . $value['id'] . "_check.jpg") ) {	$check = ".jpg"; } 
					if ( file_exists($_SERVER['DOCUMENT_ROOT'] . "/upload/users/" . $_SESSION['user']['phone'] . "/" . $value['id'] . "_check.jpeg") ) { $check = ".jpeg"; } 

					if ( file_exists($_SERVER['DOCUMENT_ROOT'] . "/upload/users/" . $_SESSION['user']['phone'] . "/" . $value['id'] . "_passport.png") ) { $passport = ".png"; } 
					if ( file_exists($_SERVER['DOCUMENT_ROOT'] . "/upload/users/" . $_SESSION['user']['phone'] . "/" . $value['id'] . "_passport.jpg") ) { $passport = ".jpg"; } 
					if ( file_exists($_SERVER['DOCUMENT_ROOT'] . "/upload/users/" . $_SESSION['user']['phone'] . "/" . $value['id'] . "_passport.jpeg") ) { $passport = ".jpeg"; } 
					$warranty_status = "";
					switch (intval($value['status'])) {
						case 2:
							$warranty_status = "одобрено";
							break;
						case 3:
							$warranty_status = "отклонено";
							break;
						default:
							$warranty_status = "на рассмотрении";
							break;
					}
					?>
					
					<tr class="warranty-left-table-item">
						<th class="warranty-left-table-item_item"><?=$value['data'];?></th>
						<td class="warranty-left-table-item_item"><?=$value['title'];?></td>
						<td class="warranty-left-table-item_item"><a target="_blank" href="https://sitename.in/upload/users/<?=$_SESSION['user']['phone'];?>/<?=$value['id'];?>_check<?=$check;?>" class="">скачать</a></td>
						<td class="warranty-left-table-item_item"><a target="_blank" href="https://sitename.in/upload/users/<?=$_SESSION['user']['phone'];?>/<?=$value['id'];?>_passport<?=$passport;?>" class="">скачать</a></td>
						<td class="warranty-left-table-item_item"><?=$value['comment'];?></td>
						<td class="warranty-left-table-item_item"><?=$warranty_status;?></td>
					</tr>

				<? } ?>
				</tbody>
			</table>
		</div>



		
	</div>

	
	<form class="warranty-right" enctype="multipart/form-data" id="warrantyRegisterForm" method="POST" action="/php/ajax/add-item-ajax.php" onsubmit="return false;"> 
	
	<div class="warranty-right"> 
		<h2>Регистрация продукта</h2>
		<input class="mb-input-warranty" type="text" name="title" id="productName" placeholder="Название продукта">
		<span>Фото чека (png, jpg, jpeg)</span><br>
		<input class="mb-input-warranty mt-input-warranty warranty-input-but-file" type="file" id="filecheck" name="filecheck" accept="image/png, image/jpeg" /><br>
		<span>Фото паспорта (png, jpg, jpeg)</span><br>
		<input  class="mb-input-warranty mt-input-warranty warranty-input-but-file" type="file" id="filepassport" name="filepassport" accept="image/png, image/jpeg" /><br>
		<div class="warranty-right-buttons">
			<button  class="button wide" id="onButRegistration" onclick="onButRegistrationClick()">Зарегистрировать</button>
			<div class="button wide warranty-logout" id="logout" onclick="customLogOut()">Выйти из аккаунта</div>
		</div>
	</div>
	</form>

</div>
<!-- v else:end -->

<? } ?>
<div class="clearboth"></div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>