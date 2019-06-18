<?php
ob_start();
session_start();
include 'baglanti.php';
error_reporting(0);

function tr_strtoupper($text)
{
    $search=array("ç","i","i","g","ö","s","ü");
    $replace=array("Ç","I","I","G","Ö","S","Ü");
    $text=str_replace($search,$replace,$text);
    $text=strtoupper($text);
    return $text;
}

// Kullanici Giris
if(isset($_POST['kullanici_giris'])){
	
	$kullanici_adi = $_POST['kullanici_adi'];
	$kullanici_sifre = md5($_POST['kullanici_sifre']);
	
	$kullanicisor = $db -> prepare('Select * from kullanici where kullanici_adi=:kullanici_adi and kullanici_sifre=:kullanici_sifre');
	$kullanicisor -> execute(array(
	'kullanici_adi' => $kullanici_adi,
	'kullanici_sifre' => $kullanici_sifre
	));

	$say = $kullanicisor->rowCount();
	
	if($say == 1){
		
		$_SESSION['kullanici_adi'] = $kullanici_adi;
		header('Location:index.php');
		exit;
		
	}else{
		
		header('Location:../index.php?durum=no');
		exit;
		
	}
	
}
//--//

// Kullanici Güncelle
if(isset($_POST['kullanici_guncelle'])){
	
	$kullanici_id = $_POST['kullanici_id'];
	$kullanici_isim = $_POST['kullanici_isim'];
	$kullanici_sifre = md5($_POST['kullanici_sifre']);
		
	$kullaniciguncelle = $db -> prepare('UPDATE kullanici SET
	
	kullanici_isim=:kullanici_isim,
	kullanici_sifre=:kullanici_sifre
	
	WHERE kullanici_id=:id
	
	');
	
	$update = $kullaniciguncelle -> execute(array(
	
	'kullanici_isim' => $kullanici_isim,
	'kullanici_sifre' => $kullanici_sifre,
		
	'id' => $kullanici_id	
		
	));
	
	if($update){
		header('Location:hesabim.php?durum=ok');
		exit;
	}else{
		header('Location:hesabim.php?durum=no');
		exit;
	}
	
}
//--//

// Kullanici Ekle
if(isset($_POST['kullanici_ekle'])){
	
	$kullanici_isim = $_POST['kullanici_isim'];
	$kullanici_adi = $_POST['kullanici_adi'];
	$kullanici_sifre = md5($_POST['kullanici_sifre']);
	$kullanici_yetki = 1;
		
	$kullaniciekle = $db -> prepare('INSERT INTO kullanici SET
	
	kullanici_isim=:kullanici_isim,
	kullanici_adi=:kullanici_adi,
	kullanici_sifre=:kullanici_sifre,
	kullanici_yetki=:kullanici_yetki
	
	');
	
	$insert = $kullaniciekle -> execute(array(
	
	'kullanici_isim' => $kullanici_isim,
	'kullanici_adi' => $kullanici_adi,
	'kullanici_sifre' => $kullanici_sifre,
	'kullanici_yetki' => $kullanici_yetki	
		
	));
	
	if($insert){
		header('Location:ayarlar.php?durum=ok');
		exit;
	}else{
		header('Location:ayarlar.php?durum=no');
		exit;
	}
	
}
//--//




//---------//




// Cari Ekle
if(isset($_POST['cari_ekle'])){
	
	$cari_firma = tr_strtoupper($_POST['cari_firma']); 
	$cari_mail = $_POST['cari_mail'];
	$cari_tel = $_POST['cari_tel'];
	$cari_not =	$_POST['cari_not']; 
	$cari_tarih = $_POST['cari_tarih'];
	
	$carisor = $db -> prepare('Select * from cari');
	$carisor -> execute();
	while($caricek = $carisor->fetch(PDO::FETCH_ASSOC)){
	
		$mevcut_cari_firma = $caricek['cari_firma'];
		$mevcut_cari_mail = $caricek['cari_mail'];
		$mevcut_cari_tel = $caricek['cari_tel'];

		if($mevcut_cari_firma == $cari_firma){
			
			header('Location:is-ekle.php?cari=firma');
			exit;

		}else if($mevcut_cari_tel == $cari_tel){
			
			header('Location:is-ekle.php?cari=tel');
			exit;
			
		}else if($cari_mail != '' && $mevcut_cari_mail == $cari_mail){
			
			header('Location:is-ekle.php?cari=mail');
			exit;
			
		}

	}
		
	$cariekle = $db -> prepare('INSERT INTO cari SET
	
	cari_firma=:cari_firma,
	cari_mail=:cari_mail,
	cari_tel=:cari_tel,
	cari_not=:cari_not,
	cari_tarih=:cari_tarih
	
	');
	
	$insert = $cariekle-> execute(array(
	
	'cari_firma' => $cari_firma,
	'cari_mail' => $cari_mail,
	'cari_tel' => $cari_tel,
	'cari_not' => $cari_not,
	'cari_tarih' => $cari_tarih	
		
	));
	
	if($insert){
		header('Location:cari.php?durum=ok');
		exit;
	}else{
		header('Location:cari.php?durum=no');
		exit;
	}
	
}
//--//


// Cari Ekle Is Eklerken
if(isset($_POST['cari_ekle_is'])){
	
	$cari_firma = tr_strtoupper($_POST['cari_firma']); 
	$cari_mail = $_POST['cari_mail'];
	$cari_tel = $_POST['cari_tel'];
	$cari_not =	$_POST['cari_not']; 
	$cari_tarih = $_POST['cari_tarih'];
	
	$carisor = $db -> prepare('Select * from cari');
	$carisor -> execute();
	while($caricek = $carisor->fetch(PDO::FETCH_ASSOC)){
	
		$mevcut_cari_firma = $caricek['cari_firma'];
		$mevcut_cari_mail = $caricek['cari_mail'];
		$mevcut_cari_tel = $caricek['cari_tel'];

		if($mevcut_cari_firma == $cari_firma){
			
			header('Location:is-ekle.php?cari=firma');
			exit;

		}else if($mevcut_cari_tel == $cari_tel){
			
			header('Location:is-ekle.php?cari=tel');
			exit;
			
		}else if($cari_mail != '' && $mevcut_cari_mail == $cari_mail){
			
			header('Location:is-ekle.php?cari=mail');
			exit;
			
		}

	}
		
	$cariekle = $db -> prepare('INSERT INTO cari SET
	
	cari_firma=:cari_firma,
	cari_mail=:cari_mail,
	cari_tel=:cari_tel,
	cari_not=:cari_not,
	cari_tarih=:cari_tarih
	
	');
	
	$insert = $cariekle-> execute(array(
	
	'cari_firma' => $cari_firma,
	'cari_mail' => $cari_mail,
	'cari_tel' => $cari_tel,
	'cari_not' => $cari_not,
	'cari_tarih' => $cari_tarih	
		
	));
	
	if($insert){
		header('Location:is-ekle.php?durum=cariok');
		exit;
	}else{
		header('Location:is-ekle.php?durum=carino');
		exit;
	}
	
}
//--//


// Cari Sil
if($_GET['cari_sil'] == 'ok'){
	
	$cari_id = $_GET['cari_id'];
	
	$issor = $db -> prepare('Select * from isler where cari_id=:cari_id');
	$issor -> execute(array(
	'cari_id' => $cari_id
	));
	$say = $issor -> rowCount();
	
	
	if($say == 0){
	
		$carisil = $db -> prepare('DELETE FROM cari 

		WHERE cari_id=:id

		');

		$kontrol = $carisil -> execute(array(

		'id' => $cari_id

		));

		if($kontrol){
			header('Location:cari.php?durum=ok');
			exit;
		}else{
			header('Location:cari.php?durum=no');
			exit;
		}
		
	}else{
		
		header('Location:cari.php?durum=isvar');
		exit;
		
	}
	
}
// -- //

// Cari Güncelle
if(isset($_POST['cari_guncelle'])){
	
	$cari_id = $_POST['cari_id'];
	$cari_firma = tr_strtoupper($_POST['cari_firma']); 
	$cari_mail = $_POST['cari_mail'];
	$cari_tel = $_POST['cari_tel'];
	$cari_not =	$_POST['cari_not']; 
		
	$cariguncelle = $db -> prepare('UPDATE cari SET
	
	cari_firma=:cari_firma,
	cari_mail=:cari_mail,
	cari_tel=:cari_tel,
	cari_not=:cari_not
	
	WHERE cari_id=:cari_id
	
	');
	
	$update= $cariguncelle-> execute(array(
	
	'cari_firma' => $cari_firma,
	'cari_mail' => $cari_mail,
	'cari_tel' => $cari_tel,
	'cari_not' => $cari_not,
		
	'cari_id' => $cari_id
		
	));
	
	if($update){
		header('Location:cari.php?durum=ok');
		exit;
	}else{
		header('Location:cari.php?durum=no');
		exit;
	}
	
}
//--//





//---------//

// Is Ekle
if(isset($_POST['is_ekle'])){
	
	$is_tarih = $_POST['is_tarih'];
	$kullanici_id = $_POST['kullanici_id'];
	$cari_id = $_POST['cari_id'];
	$is_durum = 1;

	$isekle = $db -> prepare('INSERT INTO isler SET
	
	is_durum=:is_durum,
	is_tarih=:is_tarih,
	kullanici_id=:kullanici_id,
	cari_id=:cari_id
	
	');
	
	$insert = $isekle-> execute(array(
	
	'is_durum' => $is_durum,	
	'is_tarih' => $is_tarih,
	'kullanici_id' => $kullanici_id,	
	'cari_id' => $cari_id
		
	));
	
	if($insert){

		$sonissor = $db -> prepare('Select * from isler order by is_id desc');
		$sonissor -> execute();
		$soniscek = $sonissor->fetch(PDO::FETCH_ASSOC);

		$is_id = $soniscek['is_id'];
		
		header('Location:is-duzenle.php?is_id='.$is_id.'');
		exit;
		
	}else{
		header('Location:index.php?durum=no');
		exit;
	}
	
}
//--//

// Is Sil
if($_GET['is_sil'] == 'ok'){
	
	$is_id = $_GET['is_id'];
	
	$issil = $db -> prepare('DELETE FROM isler 
	
	WHERE is_id=:id
	
	');
	
	$kontrol = $issil -> execute(array(
	
	'id' => $is_id
		
	));
	
	if($kontrol){
		
		$isodemesil = $db -> prepare('DELETE FROM odeme 
	
		WHERE is_id=:id

		');

		$kontrolek = $isodemesil -> execute(array(

		'id' => $is_id

		));
		
		if($kontrolek){
			header('Location:index.php?durum=ok');
			exit;
		}else{
			header('Location:index.php?durum=no');
			exit;
		}
		
	}else{
		header('Location:index.php?durum=no');
		exit;
	}
}
//--//

// Is Sil Tüm Isler Sayfasindan
if($_GET['is_sil'] == 'oktum'){
	
	$is_id = $_GET['is_id'];
	
	$issil = $db -> prepare('DELETE FROM isler 
	
	WHERE is_id=:id
	
	');
	
	$kontrol = $issil -> execute(array(
	
	'id' => $is_id
		
	));
	
	if($kontrol){
		
		$isodemesil = $db -> prepare('DELETE FROM odeme 
	
		WHERE is_id=:id

		');

		$kontrolek = $isodemesil -> execute(array(

		'id' => $is_id

		));
		
		if($kontrolek){
			header('Location:tum-isler.php?durum=ok');
			exit;
		}else{
			header('Location:tum-isler.php?durum=no');
			exit;
		}
		
	}else{
		header('Location:index.php?durum=no');
		exit;
	}
}
//--//

// Is Sil Bitmis Isler Sayfasindan
if($_GET['is_sil'] == 'okbit'){
	
	$is_id = $_GET['is_id'];
	
	$issil = $db -> prepare('DELETE FROM isler 
	
	WHERE is_id=:id
	
	');
	
	$kontrol = $issil -> execute(array(
	
	'id' => $is_id
		
	));
	
	if($kontrol){
		
		$isodemesil = $db -> prepare('DELETE FROM odeme 
	
		WHERE is_id=:id

		');

		$kontrolek = $isodemesil -> execute(array(

		'id' => $is_id

		));
		
		if($kontrolek){
			header('Location:bitmis-isler.php?durum=ok');
			exit;
		}else{
			header('Location:bitmis-isler.php?durum=no');
			exit;
		}
		
	}else{
		header('Location:index.php?durum=no');
		exit;
	}
}
//--//

// Is Güncelle
if(isset($_POST['is_guncelle'])){
	
	
	$is_id = $_POST['is_id'];
	$is_aciklama = $_POST['is_aciklama'];
			
	$isguncelle= $db -> prepare('UPDATE isler SET
	
	is_aciklama=:is_aciklama
	
	WHERE is_id=:is_id
	
	');
	
	$update = $isguncelle-> execute(array(

	'is_aciklama' => $is_aciklama,
		
	'is_id' => $is_id	
		
	));
	
	if($update){
		header('Location:is-duzenle.php?durum=ok&is_id='.$is_id.'');
		exit;
	}else{
		header('Location:is-duzenle.php?durum=no&is_id='.$is_id.'');
		exit;
	}
	
}
//--//


// Is Sorumlu Güncelle
if(isset($_POST['is_kullanici_guncelle'])){
	
	
	$is_id = $_POST['is_id'];
	$kullanici_id = $_POST['kullanici_id'];
			
	$isguncelle= $db -> prepare('UPDATE isler SET
	
	kullanici_id=:kullanici_id
	
	WHERE is_id=:is_id
	
	');
	
	$update = $isguncelle-> execute(array(

	'kullanici_id' => $kullanici_id,
		
	'is_id' => $is_id	
		
	));
	
	if($update){
		header('Location:is-duzenle.php?durum=ok&is_id='.$is_id.'');
		exit;
	}else{
		header('Location:is-duzenle.php?durum=no&is_id='.$is_id.'');
		exit;
	}
	
}
//--//


// Is Detay Düzenle
if(isset($_POST['is_detay_duzenle'])){
	
	$is_id = $_POST['is_id'];
	$is_ad = tr_strtoupper($_POST['is_ad']); // tr_strtoupper: ismi büyük harflerle yaz
	$is_adet = $_POST['is_adet'];
	$is_fiyat = $is_adet * $_POST['is_fiyat'];


	$isdetayekle = $db -> prepare('INSERT INTO isdetay SET
	
	is_id=:is_id,
	is_ad=:is_ad,
	is_adet=:is_adet,
	is_fiyat=:is_fiyat
	
	');
	
	$insert = $isdetayekle-> execute(array(
	
	'is_id' => $is_id,	
	'is_ad' => $is_ad,	
	'is_adet' => $is_adet,
	'is_fiyat' => $is_fiyat
		
	));
	
	if($insert){
		
		header('Location:is-duzenle.php?is_id='.$is_id.'&durumdetay=ok');
		exit;
		
	}else{
		header('Location:is-duzenle.php?is_id='.$is_id.'&durumdetay=no');
		exit;
	}
	
}
//



// Is Detay Düzenle Sil
if($_GET['isdetayduzenle_sil'] == 'ok'){
	
	$isdetay_id = $_GET['isdetay_id'];
	$is_id = $_GET['is_id'];
	
	$issil = $db -> prepare('DELETE FROM isdetay 
	
	WHERE isdetay_id=:id
	
	');
	
	$kontrol = $issil -> execute(array(
	
	'id' => $isdetay_id
		
	));
	
	if($kontrol){
		header('Location:is-duzenle.php?is_id='.$is_id.'&durumdetay=ok');
		exit;
	}else{
		header('Location:is-duzenle.php?is_id='.$is_id.'&durumdetay=no');
		exit;
	}
}
//

// Is Sonlandir
if($_GET['is_sonlandir'] == 'ok'){
	
	$is_id = $_GET['is_id'];
	$teslim = $_GET['is_teslim'];
	$odeme = $_GET['odeme'];

	if($teslim == 0 || $odeme == 0){
		header('Location:index.php?durum=teslim');
		exit;
	}else{
	
		$isguncelle= $db -> prepare('UPDATE isler SET

		is_durum=:is_durum

		WHERE is_id=:is_id

		');

		$update = $isguncelle-> execute(array(

		'is_durum' => 0,

		'is_id' => $is_id	

		));

		if($update){
			header('Location:index.php?durum=ok');
			exit;
		}else{
			header('Location:index.php?durum=no');
			exit;
		}
	}
}
//

// Is Geri Al
if($_GET['is_gerial'] == 'ok'){
	
	$is_id = $_GET['is_id'];
	
	$isguncelle= $db -> prepare('UPDATE isler SET
	
	is_durum=:is_durum
	
	WHERE is_id=:is_id
	
	');
	
	$update = $isguncelle-> execute(array(
	
	'is_durum' => 1,
		
	'is_id' => $is_id	
		
	));
	
	if($update){
		header('Location:index.php?durum=ok');
		exit;
	}else{
		header('Location:index.php?durum=no');
		exit;
	}
	
}
//

// Ödeme Ekle
if(isset($_POST['odeme_ekle'])){
	

	$is_id = $_POST['is_id'];
	$odeme_miktari = $_POST['odeme_miktari'];
	$odeme_tarih = $_POST['odeme_tarih'];
	$odeme_tipi = $_POST['odeme_tipi'];

		
		$odemeekle = $db -> prepare('INSERT INTO odeme SET

		is_id=:is_id,
		odeme_miktari=:odeme_miktari,
		odeme_tipi=:odeme_tipi,
		odeme_tarih=:odeme_tarih

		');

		$insert = $odemeekle -> execute(array(

		'is_id' => $is_id,
		'odeme_miktari' => $odeme_miktari,
		'odeme_tipi' => $odeme_tipi,	
		'odeme_tarih' => $odeme_tarih

		));

		if($insert){

			header('Location:is-duzenle.php?durum=ok&is_id='.$is_id.'');
			exit;

		}else{
			header('Location:is-duzenle.php?durum=no&is_id='.$is_id.'');
			exit;
		}

}
//--//





// Ödeme Sil
if($_GET['odeme_sil'] == 'ok'){
	
	$odeme_id = $_GET['odeme_id'];
	$is_id = $_GET['is_id'];
	$odeme_miktari = $_GET['odeme_miktari'];
	
	$odemesil = $db -> prepare('DELETE FROM odeme 
	
	WHERE odeme_id=:id
	
	');
	
	$kontrol = $odemesil -> execute(array(
	
	'id' => $odeme_id
		
	));
	
		if($kontrol){
		
		header('Location:is-duzenle.php?durum=ok&is_id='.$is_id.'');
		exit;
			
		}else{
			
		header('Location:is-duzenle.php?durum=no&is_id='.$is_id.'');
		exit;
		}
}
//--//


// Teslim Edildi Yap
if(isset($_POST['teslim_edildi_yap'])){
	
	
	$is_id = $_POST['is_id'];
	
	$isguncelle= $db -> prepare('UPDATE isler SET
	
	is_teslim=:is_teslim
	
	WHERE is_id=:is_id
	
	');
	
	$update = $isguncelle-> execute(array(

	'is_teslim' => 1,
		
	'is_id' => $is_id	
		
	));
	
	if($update){
		header('Location:index.php?durum=ok');
		exit;
	}else{
		header('Location:index.php?durum=no');
		exit;
	}
	
}
//--//

// Teslim Edildi Yap Tüm Isler Sayfasindan
if(isset($_POST['teslim_edildi_yap_tum'])){
	
	
	$is_id = $_POST['is_id'];

	$isguncelle= $db -> prepare('UPDATE isler SET
	
	is_teslim=:is_teslim
	
	WHERE is_id=:is_id
	
	');
	
	$update = $isguncelle-> execute(array(

	'is_teslim' => 1,
		
	'is_id' => $is_id	
		
	));
	
	if($update){
		header('Location:tum-isler.php?durum=ok');
		exit;
	}else{
		header('Location:tum-isler.php?durum=no');
		exit;
	}
	
}
//--//

// Teslim Edilmedi Yap
if(isset($_POST['teslim_edilmedi_yap'])){
	
	
	$is_id = $_POST['is_id'];
			
	$isguncelle= $db -> prepare('UPDATE isler SET
	
	is_teslim=:is_teslim
	
	WHERE is_id=:is_id
	
	');
	
	$update = $isguncelle-> execute(array(

	'is_teslim' => 0,
		
	'is_id' => $is_id	
		
	));
	
	if($update){
		header('Location:index.php?durum=ok');
		exit;
	}else{
		header('Location:index.php?durum=no');
		exit;
	}
	
}
//--//

// Teslim Edilmedi Yap Tüm Isler Sayfasindan
if(isset($_POST['teslim_edilmedi_yap_tum'])){
	
	
	$is_id = $_POST['is_id'];
			
	$isguncelle= $db -> prepare('UPDATE isler SET
	
	is_teslim=:is_teslim
	
	WHERE is_id=:is_id
	
	');
	
	$update = $isguncelle-> execute(array(

	'is_teslim' => 0,
		
	'is_id' => $is_id	
		
	));
	
	if($update){
		header('Location:tum-isler.php?durum=ok');
		exit;
	}else{
		header('Location:tum-isler.php?durum=no');
		exit;
	}
	
}
//--//


// Is Iskonto Ekle
if(isset($_POST['is_iskonto_ekle'])){
	
	$is_id = $_POST['is_id'];
	$is_iskonto = $_POST['is_iskonto'];
	$kalan = $_POST['kalan'];
	
	if($kalan == 0){
		
		header('Location:is-duzenle.php?durum=ihata&is_id='.$is_id.'');
		exit;
		
	}

	$isguncelle= $db -> prepare('UPDATE isler SET
	
	is_iskonto=:is_iskonto
	
	WHERE is_id=:is_id
	
	');
	
	$update = $isguncelle-> execute(array(

	'is_iskonto' => $is_iskonto,
		
	'is_id' => $is_id	
		
	));
	
	if($update){
		header('Location:is-duzenle.php?durum=iok&is_id='.$is_id.'');
		exit;
	}else{
		header('Location:is-duzenle.php?durum=ino&is_id='.$is_id.'');
		exit;
	}
	
}
//--//


//---------//



?>
