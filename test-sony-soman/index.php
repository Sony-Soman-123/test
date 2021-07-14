<?php
session_start();

include 'sql_connect.php';

$time_gap = 5; // in seconds

$employees_arr = array();
$employees_arr["records"] = array();

$sql    = "SELECT * FROM employees";
$result = $mysqli -> query($sql);

if (isset($_SESSION['last_hitted']))
{
    if (time() - $_SESSION['last_hitted'] > $time_gap)
    {
      while ($row = $result -> fetch_row()) {
        $response = array(
            "name" => $row[1],
            "designation" => $row[2],
            "salary" => $row[3]
        );
        array_push($employees_arr["records"], $response);
      }

        http_response_code(200);
        echo json_encode($employees_arr);

        $_SESSION['last_hitted'] = time();
    }
    else
    {
        http_response_code(200);
        echo json_encode(
            array("message" => "Oops!!! API execution limit exceeded, please try after ".$time_gap." secs.")
        );
    }
}
else
{
  while ($row = $result -> fetch_row()) {
    $response = array(
        "name" => $row[1],
        "designation" => $row[2],
        "salary" => $row[3]
    );
    array_push($employees_arr["records"], $response);
  }

    http_response_code(200);
    echo json_encode($employees_arr);

    $_SESSION['last_hitted'] = time();
}

?>