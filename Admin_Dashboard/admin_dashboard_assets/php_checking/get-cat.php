<?php

include("../../../config.php");

$output = "";
$get_cat_query = mysqli_query($conn,"SELECT * FROM job_category");

if($get_cat_query){
    while($row = mysqli_fetch_assoc($get_cat_query)){
        $output .='<p class="translate" cat_id ='.$row['id'].' onclick="setfilter(this)">'.$row['label'].'</p> ';
    }

}else{
    $output .= `<p class="translate nocategory">Aucune catégorie</p>` ;
}

echo $output;
?>