<?php
include_once("dbConn.php");

if (isset($_POST["page"])) {
    $page_no = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
    if(!is_numeric($page_no))
        die("Error fetching data! Invalid page number!!!");
} else {
    $page_no = 1;
}

// get record starting position
$start = (($page_no-1) * $row_limit);

$results = $pdo->prepare("SELECT * FROM podcast ORDER BY id LIMIT $start, $row_limit");
$results->execute();

while($row = $results->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>" . 
    "<td>" . $row['episode_id'] . "</td>" . 
    "<td>" . $row['episode_name'] . "</td>" . 
    "<td>" . $row['episode_image'] . "</td>" . 
    "<td>" . $row['fetaured_name'] . "</td>" . 
    "</tr>";
}
?>