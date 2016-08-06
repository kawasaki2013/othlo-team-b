<?php /* Template Name: 登録 */
?>

探索中...


<?php

$sid = "0123456789";
$venue = "北部食堂";

$ticket = array();
$ticket['post_status'] = 'publish';
$ticket['post_type'] = 'tickets';
$ticket['post_title'] = $sid;
$ticket['post_content'] = $sid;
$ticket['post_author'] = $sid;
$ticket['tax_input'] = [array(
  'venue' => $venue
)];

$post_id = wp_insert_post($ticket);
wp_set_object_terms($post_id, $venue, 'venue', true);

$query = new WP_Query(array('venue' => $venue));
$numTickets = $query->found_posts;
print_r($query);
echo "num tickets: $numTickets";

?>
