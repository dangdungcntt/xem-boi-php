<?php
  function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }

  function getStartPoint($string, $lenPerChar, $maxWidth) {
    $len = strlen(stripUnicode($string));
    $mid = $len / 2 * $lenPerChar;
    return $maxWidth / 2 - $mid;
  }

  function splitStringToMultiLine($string, $lenOfLine = 68) {
    $res = array();
    $converted = stripUnicode($string);
    $string = explode(' ', $string);
    $converted = explode(' ', $converted);
    $j = 0;
    $max = count($string);
    while ($j < $max) {
      $curLen = 0;
      $str = '';
      while ($j < $max && $curLen + strlen($converted[$j]) < $lenOfLine) {
        $curLen += strlen($converted[$j]);
        $str .= $string[$j] . ' ';
        $j++;
      }
      array_push($res, $str);
    }
    return $res;
  } 