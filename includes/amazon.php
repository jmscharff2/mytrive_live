
<?php
function gs_getStringToSign($request_type, $expires, $uri) {
   return "$request_type\n\n\n$expires\n$uri";
}

function gs_encodeSignature($s, $key) {
    $s = utf8_encode($s);
    $s = hash_hmac('sha1', $s, $key, true);
    $s = base64_encode($s);
    return urlencode($s);
}
 
function gs_prepareS3URL($file, $bucket) {
 
  $awsKeyId = "AKIAJSFGGJKKOUVRQ25Q"; // this is the non-secret key ID.
  $awsSecretKey = "AGLw35NzfP3w55rmOv+eldpete8x3UxZtjwwpMPL"; // this is the SECRET access key!
 
 
  $file = rawurlencode($file); 
  $file = str_replace('%2F', '/', $file);
  $path = $bucket ."/". $file;
 
  $expires = strtotime('+3 hour');
 
  $stringToSign = gs_getStringToSign('GET', $expires, "/$path"); 
  $signature = gs_encodeSignature($stringToSign, $awsSecretKey); 

  $url = "https://$bucket.s3.amazonaws.com/$file";
  $url .= '?AWSAccessKeyId='.$awsKeyId
         .'&Expires='.$expires
         .'&Signature='.$signature;
        
  return $url;
}

?>