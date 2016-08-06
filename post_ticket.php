<?php /* Template Name: 登録 */
http_response_code(201);
?>



<?php

$sid = $_GET['sid'];
$venue = $_GET['venue'];

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
// print_r($query);
// echo "num tickets: $numTickets";
echo json_encode($ticket);
?>
