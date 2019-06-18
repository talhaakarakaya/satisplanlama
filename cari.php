<?php include("header.php"); ?>



                <!-- Start Page content -->
                <div class="content">
                    <div class="container-fluid">

                        



                        <div class="row">
                            <div class="col-12">
                                <div class="card-box table-responsive">
                                   
                                   <table style="width: 100%;">
                                   	<tr>
                                   		<td align="left">
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

												}else if($_GET['durum'] == 'isvar'){

											  ?>

											  <div class="alert alert-success alert-dismissible fade show" role="alert">
														<button type="button" class="close" data-dismiss="alert" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
														Bu cariye ait is kayitlari oldugu için cari silinemiyor!
													</div>

											  <?php		
												}
											  ?> 
                                  		
                                  				
                                  		
                                   		</td>
                                   		<td align="right">
											<p class="font-14 m-b-30">
											   <a href="cari-ekle.php"> 
												 <button type="button" class="btn btn-success waves-effect waves-light"> <span>Cari Ekle</span> </button>
											   </a>
											</p>
                                  		</td>
                                   	</tr>
                                   </table>

                                    
                                    
                            	    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap dikey" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead class="dikey">
                                        <tr>
                                            <th>Sira</th>
                                            <th>Cari No</th>
                                            <th>Firma</th>
                                            <th>Tel</th>
                                            <th>Email</th>
                                            <th>Ek</th>
                                        </tr>
                                        </thead>


                                        <tbody class="dikey">
                                        
                                        <?php
											$carisirasay = 0;
											$carisor = $db -> prepare('Select * from cari');
											$carisor -> execute();
											while($caricek = $carisor->fetch(PDO::FETCH_ASSOC)){ $carisirasay++;
										?>
										
										
                                        <tr>
                                            <td><?php echo $carisirasay; ?></td>
                                            <td>#RN<?php echo $caricek['cari_id'] ?></td>
                                            <td><?php echo $caricek['cari_firma']; ?></td>
                                            
                                            <?php
												$harfler=str_split($caricek['cari_tel']);
												$cari_tel = '90'.$harfler[1].$harfler[2].$harfler[3].$harfler[6].$harfler[7].$harfler[8].$harfler[10].$harfler[11].$harfler[12].$harfler[13];
																								
												$cari_tel_duzgun = '+90 '.$harfler[1].$harfler[2].$harfler[3].' '.$harfler[6].$harfler[7].$harfler[8].' '.$harfler[10].$harfler[11].' '.$harfler[12].$harfler[13];
											?>
                                            
                                            <td><a href="https://wa.me/<?php echo $cari_tel; ?>?text=Merhaba,%20Reklam%20Noktasi'ndan%20ulasiyorum.%20" style="font-weight: bold; color: black" target="_blank"><?php echo $cari_tel_duzgun; ?></a></td>
                                            <td><?php echo $caricek['cari_mail'] ?></td>
                                            <td>
                                            	
                                       			<a href="cari-cikti.php?cari_id=<?php echo $caricek['cari_id']; ?>"><button type="button" class="btn btn-icon waves-effect waves-light btn-purple" style="height: 30px; width: 30px; padding: 0;">
                                       			<i class="fa fa-file-archive-o"></i></button></a>
                                       			
                                        		<a href="cari-duzenle.php?cari_id=<?php echo $caricek['cari_id']; ?>"><button type="button" class="btn btn-icon waves-effect waves-light btn-warning"style="height: 30px; width: 30px; padding: 0;">
                                        		<i class="fa fa-pencil"></i></button></a>
                                        		
                                        		<a href="islem.php?cari_id=<?php echo $caricek['cari_id']; ?>&cari_sil=ok"><button type="button" class="btn btn-icon waves-effect waves-light btn-danger" style="height: 30px; width: 30px; padding: 0;">
                                        		<i class="fa fa-trash"></i></button></a>

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
