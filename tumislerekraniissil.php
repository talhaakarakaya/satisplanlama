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
