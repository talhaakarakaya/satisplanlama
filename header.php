<?php
ob_start();
session_start();
include 'baglanti.php';
error_reporting(0);

$kullanicisor = $db -> prepare('Select * from kullanici where kullanici_adi=:kullanici_adi');
$kullanicisor -> execute(array(
'kullanici_adi' => $_SESSION['kullanici_adi']
));

$say = $kullanicisor -> rowCount();

$kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);

if($say == 0){
	
	header('Location: ../index.php?durum=izinsiz');
	exit;
}


date_default_timezone_set('Europe/Istanbul');

$gunler = array(
    'Pazartesi',
    'Sali',
    'Çarsamba',
    'Persembe',
    'Cuma',
    'Cumartesi',
    'Pazar'
);
 
$aylar = array(
    'Ocak',
    'Subat',
    'Mart',
    'Nisan',
    'Mayis',
    'Haziran',
    'Temmuz',
    'Agustos',
    'Eylül',
    'Ekim',
    'Kasim',
    'Aralik'
);

$ay = $aylar[date('m') - 1];
$gun = $gunler[date('N') - 1];


function tr_strtoupper($text)
{
    $search=array("ç","i","i","g","ö","s","ü");
    $replace=array("Ç","I","I","G","Ö","S","Ü");
    $text=str_replace($search,$replace,$text);
    $text=strtoupper($text);
    return $text;
}


$carisaysor = $db -> prepare('Select * from cari');
$carisaysor -> execute();

$carisay = $carisaysor -> rowCount();

$issaysor = $db -> prepare('Select * from isler where is_durum=:is_durum');
$issaysor -> execute(array(
'is_durum' => 1
));

$issay = $issaysor -> rowCount();

$bitmisissaysor = $db -> prepare('Select * from isler where is_durum=:is_durum');
$bitmisissaysor -> execute(array(
'is_durum' => 0
));

$bitmisissay = $bitmisissaysor -> rowCount();

$tedarikcisaysor = $db -> prepare('Select * from tedarikci');
$tedarikcisaysor -> execute();

$tedarikcisay = $tedarikcisaysor -> rowCount();

$tissaysor = $db -> prepare('Select * from tedarikci_isler where durum=:durum');
$tissaysor -> execute(array(
'durum' => 1
));

$tissay = $tissaysor -> rowCount();

$tbitmisissaysor = $db -> prepare('Select * from tedarikci_isler where durum=:durum');
$tbitmisissaysor -> execute(array(
'durum' => 0
));

$tbitmisissay = $tbitmisissaysor -> rowCount();


$sablonustkategorisaysor = $db -> prepare('Select * from sablon_ustkategori');
$sablonustkategorisaysor -> execute();

$sablonustkategorisay = $sablonustkategorisaysor -> rowCount();

$sablonsaysor = $db -> prepare('Select * from sablon');
$sablonsaysor -> execute();

$sablonsay = $sablonsaysor -> rowCount();

$sablondosyasaysor = $db -> prepare('Select * from sablon_dosya');
$sablondosyasaysor -> execute();

$sablondosyasay = $sablondosyasaysor -> rowCount();

$fiyatteklifisor = $db -> prepare('Select * from fiyat_teklifi');
$fiyatteklifisor -> execute();

$fiyatteklifisay = $fiyatteklifisor -> rowCount();

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Otomasyon - Talha Karakaya</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="Talha Karakaya" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="robots" content="noindex">
        <link rel="shortcut icon" href="../images/icons/favicon.ico">
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/metismenu.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
        <script src="assets/js/modernizr.min.js"></script>
        
        <!-- DataTables -->
        <link href="../plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="../plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="../plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Multi Item Selection examples -->
        <link href="../plugins/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        
        
        <!-- Plugins css-->
        <link href="../plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" />
        <link href="../plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
        <link href="../plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../plugins/switchery/switchery.min.css" />
        
         <!-- Custom box css -->
        <link href="../plugins/custombox/css/custombox.min.css" rel="stylesheet">
        
        <style>
			.dikey td,th{
				vertical-align: middle;
				text-align: center;
			}
		</style>
        
        
    </head>


    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">

                <div class="slimscroll-menu" id="remove-scroll">

                    <!-- LOGO -->
                    <div class="topbar-left">
                        <a href="index.php" class="logo">
                            <span>
                                <img src="assets/images/logo.png">
                            </span>
                            <i>
                                <img src="assets/images/logo_sm.png" height="28">
                            </i>
                        </a>
                    </div>

                    <!-- User box
                    <div class="user-box">
                        <div class="user-img">
                           <img src="assets/images/users/avatar-1.jpg" class="rounded-circle img-fluid">
                        </div>
                        <h5><a href="#"><?php // echo $kullanicicek['kullanici_isim']; ?></a> </h5>
                    </div>

                    <!--- Sidemenu -->
                    <div id="sidebar-menu" style="padding-top: 80px">

                        <ul class="metismenu" id="side-menu">

                            <!--<li class="menu-title">Navigation</li>-->
                            
                            <li>
                                <a href="javascript: void(0);"><i class="fi-briefcase"></i> <span> Isler </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="index.php"><span class="badge badge-danger badge-pill float-right"><?php echo $issay; ?></span> <span> Yapilacaklar </span></a></li>
                                    <li><a href="bitmis-isler.php"><span class="badge badge-success badge-pill float-right"><?php echo $bitmisissay; ?></span> <span> Bitenler </span></a></li>
                                    <li><a href="cari.php"><span class="badge badge-success badge-pill float-right"><?php echo $carisay; ?></span> <span> Cari - Rapor </span></a></li>
                                </ul>
                            </li>
                            

                            
                            <!--
                            <li>
                                <a href="rapor.php">
                                    <i class="fi-bar-graph-2"></i> <span> Rapor </span>
                                </a>
                            </li>
                            -->

                        </ul>

                    </div>
                    <!-- Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->

            <div class="content-page">

                <!-- Top Bar Start -->
                <div class="topbar">

                    <nav class="navbar-custom">

                        <ul class="list-unstyled topbar-right-menu float-right mb-0">

                            <li class="dropdown notification-list">
                                <a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" role="button"
                                   aria-haspopup="false" aria-expanded="false">
                                    <img src="assets/images/users/avatar-1.jpg" alt="user" class="rounded-circle"> <span class="ml-1"><?php echo $kullanicicek['kullanici_isim']; ?> <i class="mdi mdi-chevron-down"></i> </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown">

                                    <!-- item-->
                                    <a href="hesabim.php" class="dropdown-item notify-item">
                                        <i class="fi-head"></i> <span>Hesabim</span>
                                    </a>

                                    <!-- item-->
                                    <a href="ayarlar.php" class="dropdown-item notify-item">
                                        <i class="fi-cog"></i> <span>Ayarlar</span>
                                    </a>

                                    <!-- item-->
                                    <a href="cikis.php" class="dropdown-item notify-item">
                                        <i class="fi-power"></i> <span>Çikis</span>
                                    </a>

                                </div>
                            </li>

                        </ul>

                        <ul class="list-inline menu-left mb-0">
                            <li class="float-left">
                                <button class="button-menu-mobile open-left disable-btn">
                                    <i class="dripicons-menu"></i>
                                </button>
                            </li>
                            <li>
                                <div class="page-title-box">
                                    <h4 class="page-title">Talha Karakaya Otomasyon Sistemi </h4>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active"><a href="http://www.seyahatetsene.com" class="breadcrumb-item" target="_blank">www.seyahatetsene.com</a></li>
                                    </ol>
                                </div>
                            </li>

                        </ul>

                    </nav>

                </div>
                <!-- Top Bar End -->
