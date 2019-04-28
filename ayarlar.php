<?php include("header.php"); ?>



                <!-- Start Page content -->
                <div class="content">
                    <div class="container-fluid">

                
                
                 <div class="row">
                    <div class="col-lg-6">
                       <div class="card-box ribbon-box">
                                    <div class="ribbon ribbon-custom" style="height: 40px; font-size: 20px">Sisteme Yeni Kullanıcı Ekle</div>

                            <form class="" action="islem.php" method="post" style="margin-top: 70px;">
                              
                              
                              <?php 
							
								if($_GET['durum'] == 'no'){
									
							  ?>
							  
							  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        İşlem Başarısız!
                               </div>
							  
							  <?php
									
								}else if($_GET['durum'] == 'ok'){
									
							  ?>
							  
							  <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        İşlem Başarılı!
                                    </div>
							  
							  <?php		
								}
							  ?> 
                               
                                
                                <div class="form-group">
                                    <label>Kullanıcı Ad Soyad</label>
                                    <input type="text" name="kullanici_isim" class="form-control" required
                                           maxlength="30" placeholder="(Ör: Talha Karakaya)"/>
                                </div>
                                
                                <div class="form-group">
                                    <label>Kullanıcı Adı</label>
                                    <input type="text" name="kullanici_adi" class="form-control" required
                                           maxlength="30" placeholder="(Ör: personel - Bitişik yazınız ve Türkçe karakter kullanmayınız)"/>
                                </div>
                                
                                <div class="form-group">
                                    <label>Kullanıcı Şifre</label>
                                    <input type="password" name="kullanici_sifre" class="form-control" required
                                           maxlength="8" placeholder="(Maksimum 8 karakter)"/>
                                </div>

                                <div class="form-group">
                                    <div>
                                        <button type="submit" name="kullanici_ekle" class="btn btn-custom waves-effect waves-light">
                                            Sisteme Yeni Kullanıcı Ekle
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
        
        <!-- Parsley js -->
        <script type="text/javascript" src="../plugins/parsleyjs/parsley.min.js"></script>
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
