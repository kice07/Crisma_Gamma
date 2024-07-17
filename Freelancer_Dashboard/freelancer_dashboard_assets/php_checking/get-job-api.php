<?php

include("../../../config.php");
session_start();

$jobs_query = mysqli_query($conn, "SELECT * FROM jobs");
$action = $_POST['state'];
$data_list = [];

while ($row = mysqli_fetch_assoc($jobs_query)) {
   
        $data_list[] = [
            "id" => $row["id"],
            "title" => $row["title"],
            "job_sub_category" => $row["job_sub_category"],
            "currency" => $row["currency"],
            "salary" => $row["salary"],
            "job_type" => $row["job_type"],
            "experience" => $row["experience"],
            "post_date" => $row["post_date"],
            "expire_date" => $row["expire_date"],
            "applicants" => $row["applicants"]
        ];
    
}
$json_data = json_encode($data_list, JSON_PRETTY_PRINT);
header('Content-Type: application/json');
echo $json_data;
