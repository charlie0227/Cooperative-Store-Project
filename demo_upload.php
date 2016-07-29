<?php
/*
 * 這個檔案需處理上傳並且回傳訊息給 client 端
 * 1. 成功時回傳檔名，格式如下：
 *    {'success': 'filename.jpg'}
 * 2. 失敗時回傳錯誤訊息：
 *    {'error': 'error message'}
 */

//隨機回傳成功或失敗
if (mt_rand(1, 3) != 1) {
  //成功時回傳處理過後的檔名
  $random = rand(1, 5);
  $rtn = array('success' => 'images/sample'. $random .'.jpg');
} else {
  //失敗時回傳錯誤訊息
  $rtn = array('error' => 'upload file too big or something!');
}
echo json_encode($rtn);

sleep(rand(1, 3));  //模擬上傳過程的耗時時間
?>