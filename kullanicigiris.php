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
