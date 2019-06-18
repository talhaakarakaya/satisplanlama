<?php include("header.php"); ?>



                <!-- Start Page content -->
                <div class="content">
                    <div class="container-fluid">

                        



                        <div class="row">
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
                                        <input type="text" name="cari_tel" placeholder="" data-mask="(999) 999-9999" class="form-control" required>
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
                                        <button type="submit" name="cari_ekle" class="btn btn-custom waves-effect waves-light">
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
