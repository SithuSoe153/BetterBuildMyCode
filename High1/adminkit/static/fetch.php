<?php

include('connect.php');


if (isset($_POST['view'])) {

  // $con = mysqli_connect("localhost", "root", "", "notif");

  if ($_POST["view"] != '') {
    $update_query = "UPDATE message SET message_status = 1 WHERE message_status=0";
    mysqli_query($con, $update_query);
  }

  $query = "SELECT * FROM message m, staff s Where m.staffid = s.staffid ORDER BY messageid DESC LIMIT 4";
  $result = mysqli_query($con, $query);

  function time_elapsed_string($datetime, $full = false)
  {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
      'y' => 'year',
      'm' => 'month',
      'w' => 'week',
      'd' => 'day',
      'h' => 'hour',
      'i' => 'minute',
      's' => 'second',
    );
    foreach ($string as $k => &$v) {
      if ($diff->$k) {
        $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
      } else {
        unset($string[$k]);
      }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
  }

  $output = '';

  // echo time_elapsed_string($messagedate);

  if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_array($result)) {
      $staffprofile = $row['staffprofile'];
      $staffname = $row['staffname'];
      $messagedate = $row['messagedate'];
      $messagetitle = $row['message_title'];
      $messagedescription = $row['messagedescription'];

      $messagedatechange = time_elapsed_string($row['messagedate']);

      $output .= '

      <a href="#" class="list-group-item">
								<div class="row g-0 align-items-center">
									<div class="col-2">
                    <img src=' . $staffprofile . ' class="avatar img-fluid rounded-circle" alt=' . $staffname . '>
									</div>
									<div class="col-10">
										<div class="text-dark">' . $staffname . '</div>
                    <div class="text-muted small mt-1">' . $messagetitle . '</div>
										<div class="text-muted small mt-1">' . $messagedescription . '</div>
										<div class="text-muted small mt-1">' . $messagedatechange . '</div>
									</div>
								</div>
							</a> 
              ';
    }
  } else {
    $output .= '
    <li><a href="#" class="text-bold text-italic">No Noti Found</a></li>';
  }

  $output .= '
  <div class="dropdown-menu-footer">			
  <a href="#" class="text-muted">Show all notifications</a>
						</div>
  ';


  $status_query = "SELECT * FROM message WHERE message_status=0";
  $result_query = mysqli_query($con, $status_query);
  $count = mysqli_num_rows($result_query);

  $data = array(
    'notification' => $output,
    'unseen_notification'  => $count,
  );


  echo json_encode($data);
}
