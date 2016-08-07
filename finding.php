<?php /* Template Name: finding */

$sid = $_GET['sid'];
$venue = $_GET['venue'];

$term = get_term_by('name', $venue, 'venue');

// wp_update_term($term->term_id, 'venue', array(
//   'description' => 'testcomment'
// ));
?>
  <h1><?php echo $venue;?>を設定</h1>
<input type="hidden" name="term_id" value="<?php echo $term->term_id; ?>">
<input type="text" name="comment" id="venue-comment">
<input type="button" id="update_venue-btn" value="設定する" style="cursor: pointer;">


<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script>
$(document).ready(function(){
  $("#update_venue-btn").click(function() {
    // if(!window.confirm('<?php echo $venue;?> の募集を締め切ります。')){
      // return;
    //} 
    var post_url = "<?php echo home_url('/'); ?>update_venue?term_id=<?php echo $term->term_id; ?>&comment=" + 
            $("#venue-comment").val();
    console.log(post_url);
    $.ajax({
      type: "POST",
      url: post_url,
      success: function(data, dataType) {
        console.log(data);
        console.log($('#update_venue-btn'));
        $('#update_venue-btn').val('設定完了！').attr('disabled', 'disabled');
        window.location.href='<?php echo home_url('/')?>result<?php echo "?sid=$sid&venue=$venue"; ?>';
      }
    });
  });
});
</script>
