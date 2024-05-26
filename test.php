<?php 
include 'src/fbreelsdownloader/fbreelsdownloader.php';
use FbMediaDownloader\Downloader;
$downloader = new Downloader();
//set id
$downloader->set_url('https://www.facebook.com/sohagsrz/videos/277183161103537');
 $datas = $downloader->generate_data();
echo json_encode($datas);
// var_dump($datas);
// echo $downloader->get_response();

?>