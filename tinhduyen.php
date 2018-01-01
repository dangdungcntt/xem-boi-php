<?php  

  if (!isset($_POST['data'])) {
    die(json_encode(array(
      'success' => false,
      'error' => 'Please send with data, view data-sample https://code.tentstudy.xyz/IvKKU7tj'
    )));
  }
require_once './lib/convertUnicode.php';
require_once './lib/functions.php';

$im = ImageCreateFromJpeg("./images/tinhduyen/base.jpg"); // Path Images  

$data = $_POST['data'];

$xNam = 30;  
$xNu = 370;  

$yChung = 75; // Y  

$fontsize = "10";

$color = ImageColorAllocate($im, 0, 0, 0); // Text Color  
$colorDiem = ImageColorAllocate($im, 242, 29, 71); // Text Color  

$font = "fonts/tahomabd.ttf";
$fontTen = "fonts/bauhauhb.ttf";
$fontTieuDeTrang = "fonts/iCielBambola.ttf";
$fontTieuDe = "fonts/iCielCadena.otf";
$fontsizeTieuDe = "14";

try {

  ImagettfText($im, $fontsize + 20, 0, 200, 40, $color, $fontTieuDeTrang, 'Bói Tình Duyên');


  //tb1
  ImagettfText($im, $fontsize + 6, 0, $xNam, $yChung, $color, $fontTen, $data['tb1']['nam'][0]);
  ImagettfText($im, $fontsize + 6, 0, $xNu, $yChung, $color, $fontTen, $data['tb1']['nu'][0]);
  $yChung += 18;
  for ($i = 1; $i < 3; $i++) {
    ImagettfText($im, $fontsize, 0, $xNam, $yChung, $color, $font, $data['tb1']['nam'][$i]);
    ImagettfText($im, $fontsize, 0, $xNu, $yChung, $color, $font, $data['tb1']['nu'][$i]);
    $yChung += 18;
  }

  //tb2 tb3
  for ($i = 2; $i <= 3; $i++) {
    $yChung += 12;
    ImagettfText($im, $fontsizeTieuDe, 0, $xNam, $yChung, $color, $fontTieuDe, $data['tb'.$i]['tieuDe']);
    $yChung += 21;
    ImagettfText($im, $fontsize, 0, $xNam, $yChung, $color, $font, $data['tb'.$i]['noiDung']['thongTin']);
    $yChung += 18;
    ImagettfText($im, $fontsize, 0, $xNam, $yChung, $colorDiem, $font, $data['tb'.$i]['noiDung']['ketLuan']);
    $yChung += 18;
  }

  //tb4
  $yChung += 12;
  ImagettfText($im, $fontsizeTieuDe, 0, $xNam, $yChung, $color, $fontTieuDe, $data['tb4']['tieuDe']);
  $yChung += 21;
  for ($i = 0; $i < 3; $i++) {
  ImagettfText($im, $fontsize, 0, $xNam, $yChung, $color, $font, $data['tb4']['noiDung']['thongTin'][$i]);
  $yChung += 18;
  }
  $tb4YNghia = splitStringToMultiLine($data['tb4']['noiDung']['yNghia']);
  foreach ($tb4YNghia as $line) {
    ImagettfText($im, $fontsize, 0, $xNam, $yChung, $color, $font, $line);
    $yChung += 18;
  }
  $yChung += 2;
  ImagettfText($im, $fontsize, 0, $xNam, $yChung, $color, $font, $data['tb4']['noiDung']['ketLuanQue']);
  $yChung += 20;
  ImagettfText($im, $fontsize, 0, $xNam, $yChung, $colorDiem, $font, $data['tb4']['noiDung']['ketLuan']);
  $yChung += 18;

  //tb5
  $yChung += 12;
  ImagettfText($im, $fontsizeTieuDe, 0, $xNam, $yChung, $color, $fontTieuDe, $data['tb5']['tieuDe']);
  $yChung += 21;
  $tb5ThongTin = splitStringToMultiLine($data['tb5']['noiDung']['thongTin'] . ' ' . $data['tb5']['noiDung']['yNghia']);
  foreach ($tb5ThongTin as $line) {
    ImagettfText($im, $fontsize, 0, $xNam, $yChung, $color, $font, $line);
    $yChung += 18;
  }
  ImagettfText($im, $fontsize, 0, $xNam, $yChung, $colorDiem, $font, $data['tb5']['noiDung']['ketLuan']);
  $yChung += 18;

  //tb6
  $yChung += 12;
  ImagettfText($im, $fontsizeTieuDe, 0, $xNam, $yChung, $color, $fontTieuDe, $data['tb6']['tieuDe']);
  $yChung += 21;
  $tb6ThongTin = $data['tb6']['noiDung']['thongTin'];
  $tb6ThongTin = str_replace('quy đổi thành', '=>', $tb6ThongTin);
  $tb6ThongTin = substr($tb6ThongTin, 0, stripos($tb6ThongTin, 'tương ứng'));
  ImagettfText($im, $fontsize, 0, $xNam, $yChung, $color, $font, $tb6ThongTin);
  $yChung += 18;
  ImagettfText($im, $fontsize, 0, $xNam, $yChung, $colorDiem, $font, $data['tb6']['noiDung']['ketLuan']);
  // $yChung += 18;

  //ketQua
  $canChi = $data['ketQua']['canChi'];
  $luan = $data['ketQua']['luan'];
  $doDaiCanChi =  strlen(stripUnicode($canChi));
  $doDaiLuan = strlen(stripUnicode($luan));
  $giuaDiem = $doDaiCanChi / 2 * 11.25 - 10;
  $giuaLuan = ($doDaiCanChi - $doDaiLuan) / 2 * 11.25;
  ImagettfText($im, $fontsizeTieuDe + 4, 0, 340, $yChung - 50, $color, $fontTieuDe, $canChi);
  ImagettfText($im, $fontsizeTieuDe + 10, 0, 340 + $giuaDiem, $yChung - 18, $colorDiem, $fontTieuDe, $data['ketQua']['diem']);
  ImagettfText($im, $fontsizeTieuDe + 4, 0, 340 + $giuaLuan, $yChung + 10, $color, $fontTieuDe, $data['ketQua']['luan']);


  $random = generateRandomString(20);
  while (file_exists("./images/tinhduyen/$random.png")) {
    $random = generateRandomString(20);  
  }
  imagePng($im,"./images/tinhduyen/$random.png"); 

  ImageDestroy($im);  

  echo json_encode(array(
    'success' => true,
    'path' => $_SERVER['HTTP_HOST'] . '/images/tinhduyen/',
    'fileName' => $random,
    'ext' => 'png'
  ));
} catch (Exception $e) {
  echo json_encode(array(
    'success' => false,
    'fileName' => 'undefined error, contact admin here dangdungcntt@gmail.com'
  ));
}

?>  