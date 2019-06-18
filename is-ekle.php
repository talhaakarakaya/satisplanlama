<?php include("header.php"); ?>



                <!-- Start Page content -->
                <div class="content">
                    <div class="container-fluid">

                        

				<?php $is_kullanici_id = $kullanicicek['kullanici_id']; ?>

                  <div class="row">

                    <div class="col-lg-6">
                       <div class="card-box ribbon-box">
                                    <div class="ribbon ribbon-custom" style="height: 40px; font-size: 20px">Is Ekle</div>

                            <form class="" action="islem.php" method="post" style="margin-top: 70px;">
                              <?php 

									if($_GET['durum'] == 'carino'){

								  ?>

								  <div class="alert alert-danger alert-dismissible fade show" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											Cari eklenemedi!
								   </div>
								   
								   <?php

									}else if($_GET['cari'] == 'firma'){

								  ?>

								  <div class="alert alert-danger alert-dismissible fade show" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											Bu Firma kayitli. Lütfen asagidan seçiniz..
								   </div>
								   
								   <?php

									}else if($_GET['cari'] == 'tel'){

								  ?>

								  <div class="alert alert-danger alert-dismissible fade show" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											Bu telefon numarasina sahip Cari bilgisi kayitli. Lütfen asagidan seçiniz..
								   </div>
								   
								   <?php

									}else if($_GET['cari'] == 'mail'){

								  ?>

								  <div class="alert alert-danger alert-dismissible fade show" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											Bu mail adresine sahip Cari bilgisi kayitli. Lütfen asagidan seçiniz..
								   </div>

								  <?php

									}else if($_GET['durum'] == 'cariok'){

								  ?>

								  <div class="alert alert-success alert-dismissible fade show" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											Cari eklendi.
								   </div>

								  <?php		
									}	
								  ?>
                               <div class="form-group">
                                      <label>Cari Seç</label>
                                        
                                        <select name="cari_id" class="selectpicker" data-live-search="true" data-style="btn-custom">
											<?php
												$carisirasay = 0;
												$carisor = $db -> prepare('Select * from cari order by cari_id desc');
												$carisor -> execute();
												while($caricek = $carisor->fetch(PDO::FETCH_ASSOC)){;
											?>
											  <option value="<?php echo $caricek['cari_id']; ?>"><?php echo $caricek['cari_firma']; ?></option>
											<?php
												}
											?>
                                        </select>
                                </div>
                                
                                <div class="form-group">
                                      <label>Isin Sorumlusu</label>
                                        
                                        <select name="kullanici_id" class="selectpicker" data-live-search="true" data-style="btn-custom">
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
                                
                                <div class="form-group" style="text-align: right">
                                    <div>
                                        <input type="hidden" name="is_tarih" value="<?php echo date('j ') . $ay . date(' Y ') . $gun .' -'. date(' H:i'); ?>">
                                        <button type="submit" name="is_ekle" class="btn btn-success waves-effect waves-light">
                                            Ilerle
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    
                    <div class="col-lg-6">
                       <div class="card-box ribbon-box">
                                    <div class="ribbon ribbon-custom" style="height: 40px; font-size: 20px">Cari Ekle</div>

                            <form class="" action="islem.php" method="post" style="margin-top: 70px;">
                                
                                <div class="form-group">
                                    <label>Firma veya Müsteri Adi</label>
                                    <input type="text" name="cari_firma" class="form-control" required
                                           placeholder="(Ör: Müsteri Ad Soyad)" maxlength="30"/>
                                </div>
                                
                                <div class="form-group">
                                    <label>Cep Telefon Numarasi</label>
                                    <div>
                                        <input type="text" name="cari_tel" data-mask="(999) 999-9999" class="form-control" required>
                                            <span class="font-14 text-muted">(533) 999-9999</span>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label>Mail Adresi (Istege Bagli)</label>
                                    <input type="email" name="cari_mail" class="form-control" 
                                           placeholder="(Ör: info@musteri.com.tr)" maxlength="70"/>
                                </div>
                                
                                <div class="form-group">
                                    <label>Not (Istege Bagli)</label>
                                    <div>
                                        <textarea class="form-control" name="cari_not" maxlength="400"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div>
                                        <input type="hidden" name="cari_tarih" value="<?php echo date('d.m.Y H:i'); ?>">
                                        <button type="submit" name="cari_ekle_is" class="btn btn-custom waves-effect waves-light">
                                            Yeni Cari Ekle
                                        </button>
                                        <button type="reset" class="btn btn-light waves-effect m-l-5">
                                            Temizle
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>  

                </div>
                <!-- end row -->



                        




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

        
          <script type="text/javascript">
            $(document).ready(function() {
                $('form').parsley();
            });
        </script>
        
    </body>
</html>
