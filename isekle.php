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
