<?php  

  if (!isset($_POST['data'])) {
    die(json_encode(array(
      'success' => false,
      'error' => 'Please send with data, view data-sample https://code.tentstudy.xyz/5BPoik6H'
    )));
  }
  $arrImg = array(
    './images/ghepcau/trongbuichuoi.jpg',
    './images/ghepcau/trennocnha.jpg',
    './images/ghepcau/trongtolet.jpg',
    './images/ghepcau/tronglop.jpg',
    './images/ghepcau/trongcongvien.jpg',
    './images/ghepcau/ngoaibairac.jpg',
    './images/ghepcau/duoibien.jpg',
    './images/ghepcau/giuangatu.jpg',
    './images/ghepcau/trengiuong.jpg',
    './images/ghepcau/trongrung.jpg',
  );
require_once './lib/convertUnicode.php';
require_once './lib/functions.php';

$data = $_POST['data'];
$name = $data['name'];
$nametv = $data['nametv'];


$im = ImageCreateFromJpeg($arrImg[mt_rand(0, count($arrImg) - 1)]); // Path Images  

$color= ImageColorAllocate($im, 255, 255, 255); // Text Color  

$fontContent = "fonts/bauhauhb.ttf";
$fontName = "fonts/iCielCadena.otf";
$fontsizeName = "28";

try {
  $s1 = "Tên Tiếng Việt";
  $ss1 = getStartPoint($s1, 12, 562);
  ImagettfText(
    $im, 20, 0, $ss1, 80, $color, 
    $fontContent, $s1
  );

  $startOfName = getStartPoint($name, 20, 562);
  ImagettfText(
    $im, $fontsizeName, 0, $startOfName, 140, $color, 
    $fontName, $name
  );

  $s2 = "Tên Tiếq Việt";
  $ss2 = getStartPoint($s2, 12, 562);
  ImagettfText(
    $im, 20, 0, $ss2, 230, $color, 
    $fontContent, $s2
  );

  $startOfNameTV = getStartPoint($nametv, 20, 562);
  ImagettfText(
    $im, $fontsizeName, 0, $startOfNameTV, 290, $color, 
    $fontName, $nametv
  );
  
  //copyright
  $copyright = "© Nguyễn Đăng Dũng - FB/DangDungCNTT";
  $startCopyright = getStartPoint($copyright, 9, 562);
  ImagettfText(
    $im, 12, 0, $startCopyright + 10, 406 - 15, $color, 
    $fontContent, $copyright
  );
  
  $random = generateRandomString(20);
  while (file_exists("./images/tv/$random.png")) {
    $random = generateRandomString(20);  
  }
  imagePng($im,"./images/tv/$random.png"); 

  ImageDestroy($im);  

  echo json_encode(array(
    'success' => true,
    'path' => $_SERVER['HTTP_HOST'] . '/images/tv/',
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