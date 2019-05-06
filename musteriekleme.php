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
