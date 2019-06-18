<?php
ob_start();
session_start();
include 'baglanti.php';
error_reporting(0);
date_default_timezone_set('Europe/Istanbul');

$gunler = array(
    'Pazartesi',
    'Sali',
    'Çarsamba',
    'Persembe',
    'Cuma',
    'Cumartesi',
    'Pazar'
);
 
$aylar = array(
    'Ocak',
    'Subat',
    'Mart',
    'Nisan',
    'Mayis',
    'Haziran',
    'Temmuz',
    'Agustos',
    'Eylül',
    'Ekim',
    'Kasim',
    'Aralik'
);

$ay = $aylar[date('m') - 1];
$gun = $gunler[date('N') - 1];

$kullanicisor = $db -> prepare('Select * from kullanici where kullanici_adi=:kullanici_adi');
$kullanicisor -> execute(array(
'kullanici_adi' => $_SESSION['kullanici_adi']
));

$say = $kullanicisor -> rowCount();

$kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);

if($say == 0){
	
	header('Location: ../index.php?durum=izinsiz');
	exit;
}

?>


<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Cari Rapor Çiktisi</title>
<meta name="robots" content="noindex">
<link rel="shortcut icon" href="../images/icons/favicon.ico">

<style type="text/css">
@font-face {
    font-family: "Century Gothic";
    src: url(font1/TR - Century Gothic.TTF) format("truetype");
}
.font1 { 
    font-family: "Century Gothic", Verdana, Tahoma;
}
	
@font-face {
    font-family: "Futura";
    src: url(font1/0204.ttf) format("truetype");
}
.font2 { 
    font-family: "Futura", Verdana, Tahoma;
}	

</style>
</head>

<body>
<?php



	$cari_id = $_GET['cari_id'];
	$carisor = $db -> prepare('Select * from cari where cari_id=:cari_id');
	$carisor -> execute(array(
	'cari_id' => $cari_id
	));
	$caricek = $carisor->fetch(PDO::FETCH_ASSOC);
	
	$cari_firma = $caricek['cari_firma'];
	$cari_firma = $caricek['cari_mail'];

	$harfler=str_split($caricek['cari_tel']);
	$cari_tel = '90'.$harfler[1].$harfler[2].$harfler[3].$harfler[6].$harfler[7].$harfler[8].$harfler[10].$harfler[11].$harfler[12].$harfler[13];

	$cari_tel_duzgun = '+90 '.$harfler[1].$harfler[2].$harfler[3].' '.$harfler[6].$harfler[7].$harfler[8].' '.$harfler[10].$harfler[11].' '.$harfler[12].$harfler[13];
	
?>

<div style="width: 21cm; height: 29.7cm; background-size: 100% 100%; ">

	<table border="0" style="width: 21cm;" cellpadding="1" cellspacing="1">
		
		<tr>
			<td style="width: 1.30cm; height: 1.80cm;" rowspan="3" ><hr width="100%" size="4" color="#000;"></td>
			<td class="font2" style="width: 4.55cm; height: 1.80cm; text-align: center; font-size: 26px;" rowspan="3">#<?php echo $cari_id; ?> <br> CARI RAPORU</td>
			<td style="width: 15.1cm; height: 0.875cm; text-align: right"></td> 
		</tr>
		<tr>
			<td style="width: 15.1cm; height: 0.05cm;"><hr width="100%" size="4" color="#000;" style="padding: 0; margin: 0;"></td>
		</tr>
		<tr>
			<td style="width: 15.1cm; height: 0.875cm;"></td>
		</tr>
		
	</table>
	
	
	<table border="0" style="width: 21cm; padding-top: 10px" cellpadding="1" cellspacing="1">
		
		<tr>
			<td class="font1" style="width: 14.5cm; height: 1.38cm; font-size: 15px; padding-left: 10px;">
				<b>Müsteri:</b> <?php echo $caricek['cari_firma']; ?><br>
				<b>Telefon:</b> <?php echo $cari_tel_duzgun; ?><br>
				<b>Email:</b> <?php echo $caricek['cari_mail']; ?>
			</td>
			<td class="font1" style="width: 6.5cm; height: 1.38cm; text-align: left; font-size: 15px;" valign="top">
				<b><?php echo date('j ') . $ay . date(' Y ') . $gun .' -'. date(' H:i'); ?></b>
			</td>
		</tr>
		
	</table>
	
	<table border="0" style="width: 21cm; margin-top: 20px;" cellpadding="1" cellspacing="1">
		
		<tr>
			<td class="font1" style="width: 21cm; font-size: 17px; text-align: left; font-weight: bold; padding-left: 40px;">IS DETAYLARI</td>
		</tr>

	</table>
	
		<table class="font1 tablo1" border="0" style="width: 17cm; font-size: 11px" cellpadding="5" cellspacing="1" align="center">
			<thead>
			<tr style="text-align: left">
				<th style="border-bottom: 1px solid #ddd; text-align: left">Siparis ID</th>
				<th style="border-bottom: 1px solid #ddd; text-align: left">Tarih</th>
				<th style="border-bottom: 1px solid #ddd; text-align: left">Isi Alan</th>
				<th style="border-bottom: 1px solid #ddd; text-align: left">Toplam</th>
				<th style="border-bottom: 1px solid #ddd; text-align: left">Kalan</th>
				<th style="border-bottom: 1px solid #ddd; text-align: left">Teslim</th>
			</tr>
			</thead>
			<tbody>
			<?php
				
				$issor = $db -> prepare('Select * from isler where cari_id=:cari_id');
				$issor -> execute(array(
				'cari_id' => $cari_id
				));

							$isdetaysor = $db -> prepare('Select * from isdetay where is_id=:is_id');
							$isdetaysor -> execute(array(
							'is_id' => $is_id
							));
							$isdetaysay = $isdetaysor -> rowCount();

				while($iscek = $issor->fetch(PDO::FETCH_ASSOC)){
					
					if($isdetaycek['is_kdv']==0){ 
						$kdv = 'TL + KDV'; 
					}else{ 
						$kdv = 'TL (KDV Dahil)'; 
					}

			?>
			<tr>
				<td style="border-bottom: 1px solid #ddd; text-align: left">#RN<?php echo $iscek['is_id']; ?></td>
				<td style="border-bottom: 1px solid #ddd; text-align: left"><?php echo $iscek['is_tarih']; ?></td>
				<td style="border-bottom: 1px solid #ddd; text-align: left"><?php 				
					$isialansor = $db -> prepare('Select * from kullanici where kullanici_id=:kullanici_id');
					$isialansor -> execute(array(
					'kullanici_id' => $iscek['kullanici_id']
					));

					$isialancek = $isialansor->fetch(PDO::FETCH_ASSOC);

					echo $isialancek['kullanici_isim'];										
				?></td>
				
				<?php

					$istoplamsor1 = $db -> prepare('Select sum(is_fiyat) as kdvharic from isdetay where is_id=:is_id and is_kdv=:is_kdv');
					$istoplamsor1 -> execute(array(
					'is_id' => $iscek['is_id'],
					'is_kdv' => 0	
					));
					$kdvhariccek = $istoplamsor1->fetch(PDO::FETCH_ASSOC);

					$istoplamsor2 = $db -> prepare('Select sum(is_fiyat) as kdvdahil from isdetay where is_id=:is_id and is_kdv=:is_kdv');
					$istoplamsor2 -> execute(array(
					'is_id' => $iscek['is_id'],
					'is_kdv' => 1	
					));
					$kdvdahilcek = $istoplamsor2->fetch(PDO::FETCH_ASSOC);

					$kdvharicfiyat = $kdvhariccek['kdvharic'];
					$kdvdahilfiyat = $kdvdahilcek['kdvdahil']*1.18;

					$toplamtahsil = $kdvharicfiyat + $kdvdahilfiyat;

				 ?>
				
				<?php
						   	
					$odemetoplamsor = $db -> prepare('Select sum(odeme_miktari) as odenen from odeme where is_id=:is_id');
					$odemetoplamsor -> execute(array(
					'is_id' => $iscek['is_id']
					));
					$odemetoplamcek = $odemetoplamsor->fetch(PDO::FETCH_ASSOC);
					$odenen = $odemetoplamcek['odenen'];											

					$kalan = $toplamtahsil - $odenen;


				?>
				<td style="border-bottom: 1px solid #ddd; text-align: left"><?php echo number_format($toplamtahsil, 2, ',', '.'); ?> TL</b></td>
				
				<?php
					
					$topla = $topla + $toplamtahsil;
					$kalantopla = $kalantopla + $kalan;
					
				?>

				<td style="border-bottom: 1px solid #ddd; text-align: left"><?php echo number_format($kalan, 2, ',', '.'); ?> TL</b></td>
				
				<td style="border-bottom: 1px solid #ddd; text-align: left">
				<?php								
					$teslim = $iscek['is_teslim'];
					if($teslim == 0){
				?>
				<!-- Teslim Edilmediyse -->
					Teslim Edilmedi
				<!-- Teslim Edilmediyse/ -->
				<?php				
					}else{
				?>
				<!-- Teslim Edildiyse -->
					Teslim Edildi
				<!-- Teslim Edildiyse/ -->
				<?php					
					}											
				?>
				</td>
				
			</tr>
			<?php
			}		
			?>

			</tbody>
		</table>
		
		<table class="font1 tablo1" border="0" style="width: 17cm; margin-top: 15px;" cellpadding="5" cellspacing="1" align="center">
		
			<tr>
				<td style="width: 17cm; text-align: right">
						
					<i style="font-size: 12px;">Toplam:</i> <b style="font-size: 14px;"><?php echo number_format($topla, 2, ',', '.'); ?> TL</b><br>
					   <i style="font-size: 12px;">Kalan Tutar:</i> <b style="font-size: 14px;"><?php echo number_format($kalantopla, 2, ',', '.'); ?> TL</b>

				</td>
			</tr>
		
		</table>
		
		
		<div style="position: absolute; bottom: 70px;">

			
		</div>
		
		
		
		
		

	
</div>

</body>
</html>
