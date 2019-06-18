<?php include("header.php"); ?>


                <!-- Start Page content -->
                <div class="content">
                    <div class="container-fluid">

                        
                    <?php
					
						$is_id = $_GET['is_id'];
						$issor = $db -> prepare('Select * from isler where is_id=:is_id');
						$issor -> execute(array(
						'is_id' => $is_id
						));

						$iscek = $issor->fetch(PDO::FETCH_ASSOC);
						
						$is_kullanici_id = $iscek['kullanici_id'];
						
						$cari_id = $iscek['cari_id'];
						$carisor = $db -> prepare('Select * from cari where cari_id=:cari_id');
						$carisor -> execute(array(
						'cari_id' => $cari_id
						));
						$caricek = $carisor->fetch(PDO::FETCH_ASSOC);

						$harfler=str_split($caricek['cari_tel']);
						$cari_tel = '90'.$harfler[1].$harfler[2].$harfler[3].$harfler[6].$harfler[7].$harfler[8].$harfler[10].$harfler[11].$harfler[12].$harfler[13];
																								
						$cari_tel_duzgun = '+90 '.$harfler[1].$harfler[2].$harfler[3].' '.$harfler[6].$harfler[7].$harfler[8].' '.$harfler[10].$harfler[11].' '.$harfler[12].$harfler[13];
						
					?>

                
                <div class="row">
                
                  

                	
					<div class="col-lg-6">


						 <div class="card-box ribbon-box">
						  <div class="ribbon ribbon-custom" style="height: 35px; font-size: 17px">#RN<?php echo $iscek['is_id']; ?> / <?php echo $caricek['cari_firma']; ?> - <a href="https://wa.me/<?php echo $cari_tel; ?>?text=Merhaba,%20Reklam%20Noktasi'ndan%20ulasiyorum." style="color: white" target="_blank">(<?php echo $cari_tel_duzgun; ?>)</a></div>


							<form class="" action="islem.php" method="post" style="margin-top: 70px;">

								<?php 

									if($_GET['durumdetay'] == 'no'){

								  ?>

								  <div class="alert alert-danger alert-dismissible fade show" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											Islem Basarisiz!
								   </div>

								  <?php

									}else if($_GET['durumdetay'] == 'ok'){

								  ?>

								  <div class="alert alert-success alert-dismissible fade show" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											Islem Basarili!
								   </div>

								  <?php		
									}	
								  ?>

								  <div class="form-row">

									<div class="form-group col-md-6">
										<label>Is Adi</label>
										<input type="text" name="is_ad" class="form-control" required maxlength="40">
									</div>

									<div class="form-group col-md-2">
										<label>Is Adet</label>
										<input data-parsley-type="number" type="number" min="1" name="is_adet" class="form-control" required value="1" maxlength="7" style="text-align: center">
									</div>

									 <div class="form-group col-md-4">
										<label>Ürün Fiyati</label>
										<input data-parsley-type="number" type="number" min="1" step="0.01" name="is_fiyat" class="form-control" required maxlength="16">
									</div>

								  </div>


									<div class="form-group" style="text-align: right">
										<div>
											<input type="hidden" name="is_id" value="<?php echo $iscek['is_id']; ?>">
											<button type="submit" name="is_detay_duzenle" class="btn btn-custom waves-effect waves-light">
												Is Ekle
											</button>
										</div>
									</div>
								</form>

							<table class="table table-sm table-hover mb-0" style="text-align: center">
											<thead>
											<tr style="color: red">
												<th>Is Adi</th>
												<th>Birim Fiyat</th>
												<th>Is Adet</th>
												<th>Toplam Fiyat</th>
												<th>#</th>
											</tr>
											</thead>
											<tbody>
											<?php

												$isdetaysor = $db -> prepare('Select * from isdetay where is_id=:is_id');
												$isdetaysor -> execute(array(
												'is_id' => $is_id
												));
												$isdetaysay = $isdetaysor -> rowCount();

												while($isdetaycek = $isdetaysor->fetch(PDO::FETCH_ASSOC)){

											?>
											<tr>
												<th scope="row"><?php echo tr_strtoupper($isdetaycek['is_ad']); ?></th>
												<td><?php echo number_format($isdetaycek['is_fiyat']/$isdetaycek['is_adet'], 2, ',', '.'); ?> TL</td>
												<td><?php echo $isdetaycek['is_adet']; ?> Adet</td>
												<td><?php echo number_format($isdetaycek['is_fiyat'], 2, ',', '.'); ?> TL</td>
												<td>
												
												

												<a href="islem.php?isdetayduzenle_sil=ok&isdetay_id=<?php echo $isdetaycek['isdetay_id']; ?>&is_id=<?php echo $iscek['is_id']; ?>" style="color: red"><i class="fa fa-trash"></i></a>
												
												</td>
											</tr>
											<?php
											}		
											?>

											</tbody>
							   </table>

							   <div style="text-align: right; font-size: 20px; margin-top: 20px">
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
								  

									   
									   <i style="font-size: 14px;">Genel Toplam:</i> <b style="font-size: 19px;"><?php echo number_format($istoplamfiyat-($toplamtahsil*0.18), 2, ',', '.'); ?> TL<br></b>
									   <i style="font-size: 14px;">KDV (%18):</i> <b style="font-size: 19px;"><?php echo number_format(($toplamtahsil*0.18), 2, ',', '.'); ?> TL</b><br>
									   <i style="font-size: 14px;">Toplam Tutar:</i> <b style="font-size: 19px;"><?php echo number_format($toplamtahsil, 2, ',', '.'); ?> TL (KDV Dahil)</b>


							   </div>
							   
							   <div style="font-size: 20px; margin-top: 20px">
							   
								   <form action="islem.php" method="post" style="margin-top: 20px;">

									  <div class="form-row"> 

										 <div class="form-group col-md-12">
                                      		<label>Isin Sorumlusu</label>
                                        
											<select name="kullanici_id" class="selectpicker" data-live-search="true" data-style="btn-custom" style="width: 100%">
												<?php
													$ykullanicisor = $db -> prepare('Select * from kullanici order by kullanici_id desc');
													$ykullanicisor -> execute();
													while($ykullanicicek = $ykullanicisor->fetch(PDO::FETCH_ASSOC)){;
												?>
													<option value="<?php echo $ykullanicicek['kullanici_id']; ?>" <?php if($ykullanicicek['kullanici_id']==$is_kullanici_id){ echo 'selected'; } ?>><?php echo $ykullanicicek['kullanici_isim']; ?></option>
												<?php
													}
												?>
											</select>
                                		</div>

									  </div>


										<div class="form-group" style="text-align: right">
											<div>
												<input type="hidden" name="is_id" value="<?php echo $iscek['is_id']; ?>">
												<button type="submit" name="is_kullanici_guncelle" class="btn btn-custom waves-effect waves-light">
													Güncelle
												</button>
											</div>
										</div>
									</form>
							   
							 </div>
							   
							   <div style="font-size: 20px; margin-top: 20px">
							   
								   <form action="islem.php" method="post" style="margin-top: 20px;">
								   
								   <?php 

									if($_GET['durum'] == 'ihata'){

								  ?>

								  <div class="alert alert-danger alert-dismissible fade show" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											Ücreti alinmis ise iskonto uygulanamaz.
								   </div>

								  <?php		
									}	
								  ?>

									  <div class="form-row">

										 <div class="form-group col-md-12">
											<label>Iskonto Orani %<?php echo $iskonto; ?></label>
											<input data-parsley-type="number" type="number" min="0" max="100" name="is_iskonto" class="form-control" value="<?php echo $iskonto ?>" required maxlength="6">
										</div>

									  </div>


										<div class="form-group" style="text-align: right">
											<div>
											 	<input type="hidden" name="kalan" value="<?php echo $kalan; ?>">
												<input type="hidden" name="is_id" value="<?php echo $iscek['is_id']; ?>">
												<button type="submit" name="is_iskonto_ekle" class="btn btn-custom waves-effect waves-light">
													Iskonto Orani Güncelle
												</button>
											</div>
										</div>
									</form>
							   
							 </div>
							 
							 
							 <div style="text-align: right; font-size: 20px; margin-top: 20px">
								

									   
									   <?php
											if($iskonto > 0){
									   ?>

									   
									   <i style="font-size: 14px;">Iskonto (%<?php echo number_format($iskonto) ?>):</i> <b style="font-size: 19px;"><?php echo number_format($iskonto_orani, 2, ',', '.'); ?> TL <span style="color: red">INDIRIM UYGULANDI</span><br></b>

									   <?php				
											}										 
									   ?>
									  
							   </div>

					  	</div>
                	
                	</div> <!-- Col 6 Bitis-->

                    
                    <div class="col-lg-6">
                       <div class="card-box ribbon-box">
                                  <div style="width: 100%; height: 1px">  
                                      	<div class="ribbon ribbon-custom" style="height: 35px; font-size: 17px">GELEN ÖDEMELER</div> 
                                      	<div style="text-align: right">
                                      			<span style="margin-right: 10px;"><?php echo $iscek['is_tarih']; ?></span> <a href="is-cikti.php?is_id=<?php echo $is_id; ?>" target="_blank"><button type="button" class="btn btn-icon waves-effect waves-light btn-primary" style="height: 30px; width: 30px; padding: 0;">
                                       			<i class="fa fa-print"></i></button></a>
                                       	</div>
                                  </div>

                            <form action="islem.php" method="post" style="margin-top: 70px;">
                              
                             
                              	<?php 

									if($_GET['durum'] == 'no'){

								  ?>

								  <div class="alert alert-danger alert-dismissible fade show" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											Islem Basarisiz!
								   </div>

								  <?php

									}else if($_GET['durum'] == 'ok'){

								  ?>

								  <div class="alert alert-success alert-dismissible fade show" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											Islem Basarili!
								   </div>

								  <?php		
									}	
								  ?>
                               
                             <div class="form-row">    
                                                          
                                <div class="form-group col-md-6">
                                    <label>Yeni Ödeme Miktari</label>
                                  <input type="number" step="any" min="0.1" max="<?php echo $kalan; ?>" placeholder="Maksimum <?php echo $kalanduzgun; ?> TL" name="odeme_miktari" class="form-control" required>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label>Ödeme Tipi</label>
                                    <select class="custom-select" name="odeme_tipi" required>
                                                <option value="Nakit" selected>Nakit</option>
                                                <option value="Kredi Karti">Kredi Karti</option>
                                                <option value="Havale / EFT">Havale / EFT</option>
                                                <option value="Çek">Çek</option>
                                                <option value="Senet">Senet</option>
                                     </select>
                                </div>
                                
							  </div>    

                                <div class="form-group">
                                    <div>
                                        <input type="hidden" name="is_id" value="<?php echo $iscek['is_id']; ?>">
                                        <input type="hidden" name="odeme_tarih" value="<?php echo date('j ') . $ay . date(' Y ') . $gun .' -'. date(' H:i'); ?>">
                                        <input type="hidden" name="istoplamkontrol" value="<?php echo number_format($istoplamfiyat); ?>">
                                        <div style="text-align: right; width: 100%">
                                        <button type="submit" name="odeme_ekle" class="btn btn-custom waves-effect waves-light">
                                           Yeni Ödeme Ekle
                                        </button>
										</div>
                                    </div>
                                </div>
                            </form>
                            
                            
                            <?php
						   	$odemesor = $db -> prepare('Select * from odeme where is_id=:is_id');
							$odemesor -> execute(array(
							'is_id' => $is_id
							));
						    $odemesay = $odemesor -> rowCount();
						    ?>
                           
                            <?php if($odemesay > 0 || $odemesay != ''){ ?>
                            
                            <table class="table table-sm table-hover mb-0" style="text-align: center">
											<thead>
											<tr style="color: red">
												<th>Tarih</th>
												<th>Fiyat</th>
												<th>Ödeme Tipi</th>
												<th>#</th>
											</tr>
											</thead>
											<tbody>
											<?php
												 while($odemecek = $odemesor->fetch(PDO::FETCH_ASSOC)){ 
											?>
											<tr>
												<th scope="row"><?php echo $odemecek['odeme_tarih']; ?></th>
												<td><?php echo number_format($odemecek['odeme_miktari'], 2, ',', '.'); ?> TL</td>
												<td><?php echo $odemecek['odeme_tipi']; ?></td>
												<td>
												
												<a href="islem.php?odeme_sil=ok&odeme_id=<?php echo $odemecek['odeme_id']; ?>&is_id=<?php echo $iscek['is_id']; ?>&odeme_miktari=<?php echo $odemecek['odeme_miktari']; ?>" style="color: red"><i class="fa fa-trash"></i></a>
												
												</td>
											</tr>
											<?php
											}		
											?>

											</tbody>
							   </table>

                            <?php } ?>
                            
                            <div style="text-align: right; margin-top: 20px;">
                            	<b style="font-size: 20px;">DETAY</b><br>
                            	<p style="font-size: 20px;"> 
                            	<?php if($kalan > 1){ echo '<i style="font-size: 14px;">Kalan Tutar:</i> <span style="color: red;">'.$kalanduzgun.' TL</span>'; }else if($kalan < 1){ echo '<span style="color: green;">Kalan ödeme bulunmamaktadir.</span>';} ?></p>
                            </div>
                            
                        </div>
                    </div>

			</div> <!-- ROW BITIS-->
 

      </div> <!-- container -->
      
  </div> <!-- content -->

<?php include("footer.php"); ?>


       
       
       
       
        

         
         <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/metisMenu.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>

        <script src="../plugins/switchery/switchery.min.js"></script>
        <script src="../plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
        <script src="../plugins/select2/js/select2.min.js" type="text/javascript"></script>
        <script src="../plugins/bootstrap-select/js/bootstrap-select.js" type="text/javascript"></script>
        <script src="../plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
        <script src="../plugins/bootstrap-maxlength/bootstrap-maxlength.js" type="text/javascript"></script>

        <script type="text/javascript" src="../plugins/autocomplete/jquery.mockjax.js"></script>
        <script type="text/javascript" src="../plugins/autocomplete/jquery.autocomplete.min.js"></script>
        <script type="text/javascript" src="../plugins/autocomplete/countries.js"></script>
        <script type="text/javascript" src="assets/pages/jquery.autocomplete.init.js"></script>

        <!-- Init Js file -->
        <script type="text/javascript" src="assets/pages/jquery.form-advanced.init.js"></script>
        <script type="text/javascript" src="../plugins/parsleyjs/parsley.min.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
        
         <!-- Parsley js -->
        <script src="../plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
        <script src="../plugins/autoNumeric/autoNumeric.js" type="text/javascript"></script>

   
   		<!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
        
         <!-- Modal-Effect -->
        <script src="../plugins/custombox/js/custombox.min.js"></script>
        <script src="../plugins/custombox/js/legacy.min.js"></script>

        
        <script type="text/javascript">
            jQuery(function($) {
                $('.autonumber').autoNumeric('init');
            });
            jQuery.browser = {};
            (function () {
                jQuery.browser.msie = false;
                jQuery.browser.version = 0;
                if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
                    jQuery.browser.msie = true;
                    jQuery.browser.version = RegExp.$1;
                }
            })();
        </script>

        
          <script type="text/javascript">
            $(document).ready(function() {
                $('form').parsley();
            });
        </script>

    </body>
</html>
