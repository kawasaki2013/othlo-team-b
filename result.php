<?php /* Template Name: result*/
get_header();

$sid = $_GET['sid'];
$venue = $_GET['venue'];

$term = get_term_by('name', $venue, 'venue');

echo "<h1 id='shugo'>". $venue . " の " . 
  "<span id='venue-spot'></span>" . 
  "に集合します。</h1>";


// wp_update_term($term->term_id, 'venue', array(
//   'description' => 'testcomment'
// ));
?>
<ul class="nameData"></ul>

<input type="button" value="募集をやめる" id="close-btn">

<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
var timerStopFlag = false;
loadTickets();
function loadTickets(){
    if(timerStopFlag) return;
    $.ajax({
      url: '<?php echo home_url('/') . "result_json/?venue=$venue"; ?>',
      dataType: 'json',
      success: function(data){
        if(data == null){
          $('#close-btn').val('募集を締め切りました。').attr('disabled', 'disabled');
          return;
        }
        console.log(data);
        $('.nameData > *').remove();
        $.each(data, function(i){
          var realtime = new Date();
          var dt1 = new Date(realtime.getFullYear(),realtime.getMonth(),realtime.getDate(),realtime.getHours(),realtime.getMinutes(),realtime.getSeconds());
          console.log("現在時刻dt1=",dt1);
          var dt2 = new Date(data[i].post_date);
          console.log("post_date=",dt2);
          var diff = Math.floor((dt1-dt2)/1000); //差を秒で取得

          if (diff>60) {//60秒より多い場合
              $('.nameData').prepend("<li><span class='sid'>" + data[i].post_author +"</span><span class='dates'>"+ Math.floor(diff/60) + "分前の投稿</span></li>");
          }else {
              $('.nameData').prepend("<li><span class='sid'>" + data[i].post_author +"</span><span class='dates'>"+ diff + "秒前の投稿</span></li>");
          }
          // $('.nameData').append("<li>" + data[i].post_author + "</li>")
        });
        setTimeout(loadTickets, 5000);
      }
    });
    $.ajax({
        url: '<?php echo home_url('/') . "get_venue_description/?venue=$venue"; ?>',
        //dataType: 'json',
        success: function(data){
          if(data.length < 1) return;
          $('#venue-spot > *').remove();
          $('#venue-spot').append("<strong>" + data + "</strong>");
            console.log();
        }
    });
    return;
}

$(document).ready(function(){
  $("#close-btn").click(function() {
    // if(!window.confirm('<?php echo $venue;?> の募集を締め切ります。')){
      // return;
    //} 
    $.ajax({
      type: "POST",
      url: "<?php echo home_url('/'); ?>/delete_venue?id=<?php echo $term->term_id; ?>",
      success: function(data, dataType) {
        console.log(data);
        console.log($('#close-btn'));
        timerStopFlag = true;
        $('#close-btn').val('募集を締め切りました。').attr('disabled', 'disabled');
      }
    });
  }).css('cursor', 'pointer');
});
</script>
<?php get_footer(); ?>
