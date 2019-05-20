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
