<?php /* Template Name: result*/

$sid = $_GET['sid'];
$venue = $_GET['venue'];

$term = get_term_by('name', $venue, 'venue');

echo $venue . " の " . 
  strip_tags(term_description($term->term_id, 'venue')) .
  "に集合";


// wp_update_term($term->term_id, 'venue', array(
//   'description' => 'testcomment'
// ));
?>


<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script>
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
        $('#close-btn').val('募集を締め切りました。').attr('disabled', 'disabled');
      }
    });
  });
});
</script>
