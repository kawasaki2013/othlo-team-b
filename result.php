<?php /* Template Name: result*/

$sid = $_GET['sid'];
$venue = $_GET['venue'];

$term = get_term_by('name', $venue, 'venue');

echo $venue . " の " . 
  "<span id='venue-spot'></span>" . 
  "に集合";


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
                // console.log(data[i].post_date_gmt);
                // var realtime = new Date();
                // var dt1 = new Date(realtime.getFullYear(),(realtime.getMonth() + 1),realtime.getDate(),realtime.getHours(),realtime.getMinutes()+10,realtime.getSeconds());
                // console.log("dt1=",dt1);
                // var gettime = new Date(data[i].post_date_gmt);
                // var dt2 = new Date(gettime.getFullYear(),(gettime.getMonth() + 1),gettime.getDate(),gettime.getHours(),gettime.getMinutes(),gettime.getSeconds());
                // console.log("dt2=",dt2);
                // if(dt1.getTime() > dt2.getTime()) {
                //     //処理A
                //     console.log("dt1");
                // } else {
                //     //処理B
                //     console.log("dt2");
                // }
                $('.nameData').append("<li>" + data[i].post_date_gmt + "</li>")
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
