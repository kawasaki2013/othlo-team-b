<!-- $html = file_get_contents('http://webkaru.net/php/'); -->


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>タイトル入力</title>

	</head>
	<body>
		<h2>マッチングの結果です。<br /></h2>

		<?php
		//データの受け取り
			$sid = $_POST['sid'];
			$time = $_POST['time'];
            $venue = $_POST['venue'];

			$dates=new DateTime($time);
			$y=$dates->format('Y');//「年」表示
			$m=$dates->format('n');//0をつけない「月」表示
			$d=$dates->format('j');//「日」表示
			$H=$dates->format('H');//24時間単位での「時」表示
			$M=$dates->format('i');//「分」表示
			$S=$dates->format('s');//「秒」表示

        print '【学籍番号='.$sid.'、詳細な場所='.$venue.'、<br />開始時刻='.$y.'年 '.$m.'月 '.$d.'日 '.$H.'時 '.$M.'分 '.$S.'秒】<br />';

        $seturl = 'http://bocci.sakura.ne.jp/bocci/result_json/?venue="'.$venue.'"';
        echo $seturl;
        echo '<br /><br />';

        $json = file_get_contents($seturl);
        print_r($json);
        echo "<br /><br /><br />";

        $array = json_decode($json,true);
        echo "頭の１件だけ出力<br />";
        print_r($array);
		?>


<ul class="nameData">
    <li>test</li>
</ul>

        <script src="http://code.jquery.com/jquery-1.11.1.min.js" type="text/javascript"></script>
        <script type="text/javascript">
//         $.ajax({
// url: '<?php echo "http://bocci.sakura.ne.jp/bocci/result_json/?venue=$venue"; ?>',
// dataType: 'json',
// success: function(data){
//     console.log(data);
//     $.each(data, function(i){
//         console.log(data[i].post_date_gmt);
//         $('.nameData').append("<li>" + data[i].post_date_gmt + "</li>")
//     });
//     refresh();
// }
//
// var output = function(data){
//     console.log(data);
//     $.each(data, function(i){
//         console.log(data[i].post_date_gmt);
//         $('.nameData').append("<li>" + data[i].post_date_gmt + "</li>")
//     });
//     refresh();
// }
// var refresh = function(){
//     setTimeout(output(data),5000);
// };
//
//
// });;
loadTickets();
function loadTickets(){
    $.ajax({
        url: '<?php echo "http://bocci.sakura.ne.jp/bocci/result_json/?venue=$venue"; ?>',
        dataType: 'json',
        success: function(data){
            console.log(data);
            $('.nameData > *').remove();
            $.each(data, function(i){
                // console.log(data[i].post_date_gmt);
                var realtime = new Date();
                var dt1 = new Date(realtime.getFullYear(),(realtime.getMonth() + 1),realtime.getDate(),realtime.getHours(),realtime.getMinutes()+10,realtime.getSeconds());
                console.log("dt1=",dt1);
                var gettime = new Date(data[i].post_date_gmt);
                var dt2 = new Date(gettime.getFullYear(),(gettime.getMonth() + 1),gettime.getDate(),gettime.getHours(),gettime.getMinutes(),gettime.getSeconds());
                console.log("dt2=",dt2);
                if(dt1.getTime() > dt2.getTime()) {
                    //処理A
                    console.log("dt1");
                } else {
                    //処理B
                    console.log("dt2");
                }
                $('.nameData').append("<li>" + data[i].post_date_gmt + "</li>")
            });
            setTimeout(loadTickets, 5000);
            return;
        }
    });
}
        </script>
	</body>
</html>
