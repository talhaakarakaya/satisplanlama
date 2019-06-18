<?php
ob_start();
session_start();
include 'baglanti.php';
error_reporting(0);

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

function tr_strtoupper($text)
{
    $search=array("ç","i","i","g","ö","s","ü");
    $replace=array("Ç","I","I","G","Ö","S","Ü");
    $text=str_replace($search,$replace,$text);
    $text=strtoupper($text);
    return $text;
}

?>


<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Is Çiktisi</title>
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

	$is_id = $_GET['is_id'];
	
	$is_id = $_GET['is_id'];
	$issor = $db -> prepare('Select * from isler where is_id=:is_id');
	$issor -> execute(array(
	'is_id' => $is_id
	));

	$iscek = $issor->fetch(PDO::FETCH_ASSOC);

	$cari_id = $iscek['cari_id'];
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

<div style="width: 21cm; max-height: 29.7cm; background-size: 100% 100%;">

	<table border="0" style="width: 21cm;" cellpadding="1" cellspacing="1">
		
		<tr>
			<td style="width: 1.30cm; height: 1.80cm;" rowspan="3" ><hr width="100%" size="4" color="#000;"></td>
			<td class="font2" style="width: 4.55cm; height: 1.80cm; text-align: center; font-size: 26px;" rowspan="3">#RN<?php echo $is_id; ?> <br> SIPARIS FORMU</td>
			<td style="width: 15.1cm; height: 0.875cm; text-align: right"></td> 
		</tr>
		<tr>
			<td style="width: 15.1cm; height: 0.05cm;"><hr width="100%" size="4" color="#000;" style="padding: 0; margin: 0;"></td>
		</tr>
		<tr>
			<td style="width: 15.1cm; height: 0.875cm;"></td>
		</tr>
		
		<tr>
			<td class="font1" style="width: 21cm; height: 0.5cm; text-align: right; font-size: 17px; font-weight: bold; padding-right: 19px" colspan="3"></td>
		</tr>
		
	</table>
	
	
	<table border="0" style="width: 21cm;" cellpadding="1" cellspacing="1">
		
		<tr>
			<td class="font1" style="width: 14.5cm; height: 1.38cm; font-size: 15px; padding-left: 10px;">
				<b>Müsteri:</b> <?php echo $caricek['cari_firma']; ?><br>
				<b>Telefon:</b> <?php echo $cari_tel_duzgun; ?><br>
				<b>Email:</b> <?php echo $caricek['cari_mail']; ?>
			</td>
			<td class="font1" style="width: 6.5cm; height: 1.38cm; text-align: left; font-size: 15px;" valign="top">
				<b><?php echo $iscek['is_tarih']; ?></b> <br>
				<?php 

					$isialansor = $db -> prepare('Select * from kullanici where kullanici_id=:kullanici_id');
					$isialansor -> execute(array(
					'kullanici_id' => $iscek['kullanici_id']
					));

					$isialancek = $isialansor->fetch(PDO::FETCH_ASSOC);
				?>
				<b>Isi Alan: </b> <?php echo $isialancek['kullanici_isim']; ?> <br>
				<b>Telefon: </b> 0534 278 06 81
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
				<th style="border-bottom: 1px solid #ddd; text-align: left">Is Adi</th>
				<th style="border-bottom: 1px solid #ddd; text-align: center">Is Adet</th>
				<th style="border-bottom: 1px solid #ddd; text-align: right">Toplam Fiyat</th>
			</tr>
			</thead>
			<tbody>
			<?php

				$isdetaysor = $db -> prepare('Select * from isdetay where is_id=:is_id');
				$isdetaysor -> execute(array(
				'is_id' => $is_id
				));
				$isdetaysay = $isdetaysor -> rowCount();
				
				if($isdetaysay > 7){
					
					$fontsize = 'font-size: 12px;';
					
				}else{
					
					$fontsize = 'font-size: 12px;';
					
				}

				while($isdetaycek = $isdetaysor->fetch(PDO::FETCH_ASSOC)){
					
					if($isdetaycek['is_kdv']==0){ 
						$kdv = 'TL (KDV Dahil)'; 
					}else{ 
						$kdv = 'TL (KDV Dahil)'; 
					}

			?>
			<tr>
				<td style="border-bottom: 1px solid #ddd; text-align: left; <?php echo $fontsize; ?>"><?php echo tr_strtoupper($isdetaycek['is_ad']); ?></td>
				<td style="border-bottom: 1px solid #ddd; text-align: center; <?php echo $fontsize; ?>"><?php echo $isdetaycek['is_adet']; ?> Adet</td>
				<td style="border-bottom: 1px solid #ddd; text-align: right; <?php echo $fontsize; ?>" style="border-bottom: 1px solid #ddd;"><?php if($isdetaycek['is_kdv']==0){ echo number_format($isdetaycek['is_fiyat'], 2, ',', '.'); }else{ echo number_format($isdetaycek['is_fiyat']*1.18, 2, ',', '.'); } ?> TL</td>
			</tr>
			<?php
			}		
			?>

			</tbody>
		</table>
		
		<table class="font1 tablo1" border="0" style="width: 17cm; margin-top: 15px;" cellpadding="5" cellspacing="1" align="center">
		
			<tr>
				<td style="width: 17cm; text-align: right">
					<?php

						$istoplamsor = $db -> prepare('Select sum(is_fiyat) as istoplam from isdetay where is_id=:is_id');
						$istoplamsor -> execute(array(
						'is_id' => $is_id
						));
						$istoplamcek = $istoplamsor->fetch(PDO::FETCH_ASSOC);

						$istoplamfiyat = $istoplamcek['istoplam'];

						$iskonto = $iscek['is_iskonto'];

						$iskonto_orani = $istoplamfiyat * ($iskonto / 100);
						$toplamtahsil = $istoplamfiyat - $iskonto_orani;

						$odemetoplamsor = $db -> prepare('Select sum(odeme_miktari) as odenen from odeme where is_id=:is_id');
						$odemetoplamsor -> execute(array(
						'is_id' => $is_id
						));
						$odemetoplamcek = $odemetoplamsor->fetch(PDO::FETCH_ASSOC);
						$odenen = $odemetoplamcek['odenen'];

						$kalan = $toplamtahsil - $odenen;

						$kalanduzgun = number_format($kalan, 2, ',', '.');


					 ?>
					
				   <?php
						if($iskonto > 0){
				   ?>


				   <i style="font-size: 12px;">Iskonto (%<?php echo number_format($iskonto) ?>):</i> <b style="font-size: 16px;"><?php echo number_format($iskonto_orani, 2, ',', '.'); ?> TL</b> <br>

				   <?php				
						}										 
				   ?>	
					
				   <i style="font-size: 14px;">Genel Toplam:</i> <b style="font-size: 19px;"><?php echo number_format($istoplamfiyat-($toplamtahsil*0.18), 2, ',', '.'); ?> TL<br></b>
				   <i style="font-size: 14px;">KDV (%18):</i> <b style="font-size: 19px;"><?php echo number_format(($toplamtahsil*0.18), 2, ',', '.'); ?> TL</b><br>
				   <i style="font-size: 14px;">Toplam Tutar:</i> <b style="font-size: 19px;"><?php echo number_format($toplamtahsil, 2, ',', '.'); ?> TL (KDV Dahil)</b>
				    
				</td>
			</tr>
		
		</table>
		
		<table border="0" style="width: 21cm;" cellpadding="1" cellspacing="1">
		
			<tr>
				<td class="font1" style="width: 21cm; font-size: 17px; text-align: left; font-weight: bold; padding-left: 40px;">ÖDEME DETAYLARI</td>
			</tr>

		</table>
		
		<?php
						   	
			$odemetoplamsor = $db -> prepare('Select sum(odeme_miktari) as odenen from odeme where is_id=:is_id');
			$odemetoplamsor -> execute(array(
			'is_id' => $is_id
			));
			$odemetoplamcek = $odemetoplamsor->fetch(PDO::FETCH_ASSOC);
			$odenen = $odemetoplamcek['odenen'];

			$kalan = $toplamtahsil - $odenen;

			$kalanduzgun = number_format($kalan, 2, ',', '.');

		?>
		
		<?php
		
		$odemesor = $db -> prepare('Select * from odeme where is_id=:is_id');
		$odemesor -> execute(array(
		'is_id' => $is_id
		));
		$odemesay = $odemesor -> rowCount();
		?>

		<?php if($odemesay > 0 || $odemesay != ''){ ?>
		
		<table class="font1 tablo1" border="0" style="width: 17cm; margin-top: 15px; font-size: 11px" cellpadding="5" cellspacing="1" align="center">
			<thead>
			<tr style="text-align: left">
				<th style="border-bottom: 1px solid #ddd; text-align: left">Tarih</th>
				<th style="border-bottom: 1px solid #ddd; text-align: center">Fiyat</th>
				<th style="border-bottom: 1px solid #ddd; text-align: right">Ödeme Tipi</th>
			</tr>
			</thead>
			<tbody>
			
				<?php
					while($odemecek = $odemesor->fetch(PDO::FETCH_ASSOC)){ 
				?>

			<tr>
				<td style="border-bottom: 1px solid #ddd; text-align: left"><?php echo $odemecek['odeme_tarih']; ?></td>
				<td style="border-bottom: 1px solid #ddd; text-align: center"><?php echo number_format($odemecek['odeme_miktari'], 2, ',', '.'); ?> TL</td>
				<td style="border-bottom: 1px solid #ddd; text-align: right" style="border-bottom: 1px solid #ddd;"><?php echo $odemecek['odeme_tipi']; ?></td>
			</tr>
			
				<?php
					}		
				?>

			</tbody>
		</table>
		
		<?php } ?>
		
		<table class="font1 tablo1" border="0" style="width: 17cm; margin-top: 15px;" cellpadding="5" cellspacing="1" align="center">
		
			<tr>
				<td style="width: 17cm; text-align: right">


					   <?php if($kalan > 0){ echo '<i style="font-size: 12px;">Kalan Tutar:</i> <b style="font-size: 14px;">'.$kalanduzgun.' TL</b>'; }else{ echo '<span style="font-size: 14px;">Kalan ödeme bulunmamaktadir.</span>'; } ?>
					   
					   
				</td>
			</tr>
		
		</table>
	
	
</div>

</body>
</html>
