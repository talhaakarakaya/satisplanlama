<?php include("header.php"); ?>



                <!-- Start Page content -->
                <div class="content">
                    <div class="container-fluid">

                        



                        <div class="row">
                            <div class="col-12">
                                <div class="card-box table-responsive">
                                   
                                   <table style="width: 100%;">
                                   	<tr>
                                   		<td>
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
                                   		</td>
                                   	</tr>
                                   </table>

                                    
                                    
                            	    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap dikey" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead class="dikey">
                                        <tr>
                                            <th>Sira</th>
                                            <th>Siparis ID</th>
                                            <th>Tarih</th>
                                            <th>Isi Alan</th>
                                            <th>Cari</th>
                                            <th>Toplam</th>
                                            <th>Kalan</th>
                                            <th>Ödeme</th>
                                            <th>Teslim</th>
                                            <th>Ek</th>
                                        </tr>
                                        </thead>


                                        <tbody class="dikey">
                                        
                                         <?php
											$issirasay = 0;
											$issor = $db -> prepare('Select * from isler where is_durum=:is_durum order by is_id desc');
											$issor -> execute(array(
											'is_durum' => 0	
											));
											while($iscek = $issor->fetch(PDO::FETCH_ASSOC)){ $issirasay++;
											$is_id = $iscek['is_id'];
											$carisor = $db -> prepare('Select * from cari where cari_id=:id');
											$carisor -> execute(array(
											'id' => $iscek['cari_id']
											));
											$caricek = $carisor->fetch(PDO::FETCH_ASSOC);		
																							
										?>
                                        
                                        <tr>
                                            <td><?php echo $issirasay; ?></td>
                                            
											<td>#RN<?php echo $iscek['is_id']; ?></td> 
                                           
                                            <td><?php echo $iscek['is_tarih']; ?></td>
                                            
                                            <td><?php 
												
												$isialansor = $db -> prepare('Select * from kullanici where kullanici_id=:kullanici_id');
												$isialansor -> execute(array(
												'kullanici_id' => $iscek['kullanici_id']
												));

												$isialancek = $isialansor->fetch(PDO::FETCH_ASSOC);
																							
												echo $isialancek['kullanici_isim'];								
												
											?></td>
                                            
                                            <td><?php echo $caricek['cari_firma']; ?>
                                            
                                            <?php
												$harfler=str_split($caricek['cari_tel']);
												$cari_tel = '90'.$harfler[1].$harfler[2].$harfler[3].$harfler[6].$harfler[7].$harfler[8].$harfler[10].$harfler[11].$harfler[12].$harfler[13];
																								
												$cari_tel_duzgun = '+90 '.$harfler[1].$harfler[2].$harfler[3].' '.$harfler[6].$harfler[7].$harfler[8].' '.$harfler[10].$harfler[11].' '.$harfler[12].$harfler[13];
											?>
                                            
                                           <br> <a href="https://wa.me/<?php echo $cari_tel; ?>?text=Merhaba,%20Reklam%20Noktasi'ndan%20RN<?php echo $iscek['is_id']; ?>%20numarali%20siparisiniz%20için%20ulasiyorum.%20http://www.reklamnoktasi.com.tr" style="font-weight: bold; color: black" target="_blank"><?php echo $cari_tel_duzgun; ?></a></td>
                                            
                                             <?php

												$istoplamsor = $db -> prepare('Select sum(is_fiyat) as istoplam from isdetay where is_id=:is_id');
												$istoplamsor -> execute(array(
												'is_id' => $is_id
												));
												$istoplamcek = $istoplamsor->fetch(PDO::FETCH_ASSOC);

												$istoplamfiyat = $istoplamcek['istoplam'];

												$iskonto = $iscek['is_iskonto'];

												$iskonto_orani = $istoplamfiyat * $iskonto / 100;
																							
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
                                            
                                            <td><?php echo number_format($toplamtahsil, 2, ',', '.'); ?> TL</b></td>
                                            
                                            <td><?php echo number_format($kalan, 2, ',', '.'); ?> TL</b></td>
                                            
                                            <td>
                                            	<?php
													
													if($kalan > 1){
														
														$odeme = 0;
														echo '<span style="display:none;">0</span><button type="button" class="btn btn-icon waves-effect waves-light btn-danger"> <i class="fa fa-remove"></i> </button>';
														
													}else if($kalan < 1){
														
														$odeme = 1;
														echo '<span style="display:none;">1</span><button type="button" class="btn btn-icon waves-effect waves-light btn-success"> <i class="fa fa-thumbs-o-up"></i> </button>';
														
													}
																							
												?>
                                            </td>
                                            
                                            <td>
                                            	
                                            	<?php
													
													$teslim = $iscek['is_teslim'];
													if($teslim == 0){
												?>
												<!-- Teslim Edilmediyse -->
												
													<span style="display:none;">0</span>
													<form action="#" method="post">
													<input type="hidden" name="is_id" value="<?php echo $is_id; ?>">
													<button type="button" name="teslim_edildi_yap" class="btn btn-icon waves-effect waves-light btn-danger"> <i class="fa fa-remove"></i> </button>
													</form>
												<!-- Teslim Edilmediyse/ -->
												<?php				
													}else{
												?>
												<!-- Teslim Edildiyse -->
												
													<span style="display:none;">1</span>
													<form action="#" method="post">
													<input type="hidden" name="is_id" value="<?php echo $is_id; ?>">
													<button type="button" name="teslim_edilmedi_yap" class="btn btn-icon waves-effect waves-light btn-success"> <i class="fa fa-thumbs-o-up"></i> </button>
													</form>
												
										        <!-- Teslim Edildiyse/ -->
											    <?php					
													}											
												?>	
                                            	
                                            </td>
                                            
                                            <td>
                                            	
                                       			<a href="is-cikti.php?is_id=<?php echo $iscek['is_id']; ?>" target="_blank"><button type="button" class="btn btn-icon waves-effect waves-light btn-primary" style="height: 30px; width: 30px; padding: 0;">
                                       			<i class="fa fa-print"></i></button></a>
                                       			
                                        		<a href="islem.php?is_id=<?php echo $iscek['is_id']; ?>&is_sil=okbit"><button type="button" class="btn btn-icon waves-effect waves-light btn-danger" style="height: 30px; width: 30px; padding: 0;">
                                        		<i class="fa fa-trash"></i></button></a>
                                        		
                                        		-
                                        		
                                        		<a href="islem.php?is_id=<?php echo $iscek['is_id']; ?>&is_gerial=ok"><button type="button" class="btn btn-icon waves-effect waves-light btn-success" style="height: 30px; width: 95px; padding: 0; font-size: 12px; font-weight: bold">
                                        		Isi Geri Al</button></a>
                                       
                                        	</td>
										</tr>
                                      
                                       <?php		
											}
										?>	
                                       
                                        </tbody>
                                    </table>

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

        <!-- Required datatable js -->
        <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="../plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="../plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="../plugins/datatables/jszip.min.js"></script>
        <script src="../plugins/datatables/pdfmake.min.js"></script>
        <script src="../plugins/datatables/vfs_fonts.js"></script>
        <script src="../plugins/datatables/buttons.html5.min.js"></script>
        <script src="../plugins/datatables/buttons.print.min.js"></script>

        <!-- Key Tables -->
        <script src="../plugins/datatables/dataTables.keyTable.min.js"></script>

        <!-- Responsive examples -->
        <script src="../plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="../plugins/datatables/responsive.bootstrap4.min.js"></script>

        <!-- Selection table -->
        <script src="../plugins/datatables/dataTables.select.min.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {

                // Default Datatable
                $('#datatable').DataTable();

                //Buttons examples
                var table = $('#datatable-buttons').DataTable({
                    lengthChange: false,
                    buttons: ['excel'] 
                });

                // Key Tables

                $('#key-table').DataTable({
                    keys: true
                });

                // Responsive Datatable
                $('#responsive-datatable').DataTable();

                // Multi Selection Datatable
                $('#selection-datatable').DataTable({
                    select: {
                        style: 'multi'
                    }
                });

                table.buttons().container()
                        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
            } );

        </script>

    </body>
</html>
