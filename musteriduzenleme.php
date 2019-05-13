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
