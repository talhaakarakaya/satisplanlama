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
