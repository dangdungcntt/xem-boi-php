<?php  

  if (!isset($_POST['data'])) {
    die(json_encode(array(
      'success' => false,
      'error' => 'Please send with data, view data-sample https://code.tentstudy.xyz/5BPoik6H'
    )));
  }
  $imgNguoiYeu = './images/ghepcau/nguoiyeu.jpg';
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
  $arrContent = array(
    'day' => array(
      'Tỏ tình', 'Sờ ti', 'Tụt quần', 'Nhìn trộm', 'Hôn',
      'Búng tai', 'Ngủ cùng', 'Tát', 'Ôm', 'Mơ thấy'
    ),
    'month' => array(
      ' bạn thân', ' người yêu', ' hàng xóm', ' con chó', ' mối tình đầu',
       ' con điên', ' lớp trưởng', ' rm họ', ' Linh ka', ' hoa khôi xóm'
    ),
    'year' => array(
      'trong bụi chuối', 'trên nóc nhà', 'trong tolet',
      'trong lớp', 'trong công viên', 'ngoài bãi rác',
      'dưới biển', 'giữa ngã tư', 'trên giường', 'trong rừng'
    )
  );
require_once './lib/convertUnicode.php';
require_once './lib/functions.php';

$data = $_POST['data'];
$day = $data['day'];
$month = $data['month'];
$year = $data['year'];

$d = ((intval($day) % 10) + 10) % 10;
$m = ((intval($month) % 10) + 10) % 10;
$y = ((intval($year) % 10) + 10) % 10;

if ($m === 1) {
  $im = ImageCreateFromJpeg($imgNguoiYeu); // Path Images  
} else {
  $im = ImageCreateFromJpeg($arrImg[$y]); // Path Images  
}

$X= 30; 
$Y = 170; // Y  

$color= ImageColorAllocate($im, 255, 255, 255); // Text Color  

$fontContent = "fonts/bauhauhb.ttf";
$fontDateOfBirth = "fonts/iCielCadena.otf";
$fontsizeDateOfBirth = "24";

try {

  $dateOfBirth = "Sinh ngày: {$day}-{$month}-{$year}";
  $startDob = getStartPoint($dateOfBirth, 16, 562);
  ImagettfText(
    $im, $fontsizeDateOfBirth, 0, $startDob, 60, $color, 
    $fontDateOfBirth, $dateOfBirth
  );

  //content
  $contentL1 = $arrContent['day'][$d] . $arrContent['month'][$m];
  $contentL2 = $arrContent['year'][$y];
  $startL1 = getStartPoint($contentL1, 24, 562);
  $startL2 = getStartPoint($contentL2, 24, 562);
  ImagettfText(
    $im, $fontsizeDateOfBirth + 12, 0, $startL1, $Y, $color, 
    $fontContent, $contentL1
  );
  ImagettfText(
    $im, $fontsizeDateOfBirth + 12, 0, $startL2, $Y + 80, $color, 
    $fontContent, $contentL2
  );

  //copyright
  $copyright = "© Nguyễn Đăng Dũng - FB/DangDungCNTT";
  $startCopyright = getStartPoint($copyright, 9, 562);
  ImagettfText(
    $im, 12, 0, $startCopyright, 406 - 15, $color, 
    $fontContent, $copyright
  );
  
  $random = generateRandomString(20);
  while (file_exists("./images/ghepcau/$random.png")) {
    $random = generateRandomString(20);  
  }
  imagePng($im,"./images/ghepcau/$random.png"); 

  ImageDestroy($im);  

  echo json_encode(array(
    'success' => true,
    'path' => $_SERVER['HTTP_HOST'] . '/images/ghepcau/',
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