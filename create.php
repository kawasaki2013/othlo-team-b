<?php /* Template Name: new */
$sid_num = 8;


$sid = $_GET['sid'];
$venue = urlencode($_GET['venue']);

if(mb_strlen($sid) != $sid_num){
  http_response_code(400);
}
if(mb_strlen($venue) < 1){
  http_response_code(400);
}

http_response_code(201);
echo '{"url":"' . home_url('/') . "othlohack16/post_ticket/?sid=$sid&venue=$venue" . '"}';
 

?>