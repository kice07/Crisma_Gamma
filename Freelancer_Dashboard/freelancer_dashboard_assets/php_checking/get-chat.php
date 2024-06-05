<?php
session_start();
// if (isset($_SESSION['unique_id'])) {

// } else {
//     header("Location: ../../../login_registration.php");
// }

include_once "../../../config.php";
$outgoing_id = $_SESSION['unique_freelancer_id'];

$incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
$output = "";
$previousDate = "";
$sql = "SELECT * FROM message WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
            OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
$query = mysqli_query($conn, $sql);


if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {

        $date1 = $row['date'];

        if ($previousDate !== null && $date1 != $previousDate) {
            // $dateActuelle = new DateTime();
            // $date2 = $dateActuelle->format('d/m/Y');
            $date2 = date("d/m/Y"); 

            // Créer des objets DateTime à partir des chaînes de date
            $dateObj1 = DateTime::createFromFormat('d/m/Y', $date1);
            $dateObj2 = DateTime::createFromFormat('d/m/Y', $date2);

            // Calculer la différence entre les deux dates
            $diff = $dateObj1->diff($dateObj2);
            // Vérifier si la différence est exactement d'un jour
            if ($diff->days == 0) {
                $output .= ' <div class="coversation-divider"><span class="translate">Aujourdhui</span></div>';
            } elseif ($diff->days == 1) {
                $output .= ' <div class="coversation-divider"><span class="translate">Hier</span></div>';
            } else {
                $output .= ' <div class="coversation-divider"><span class="translate">' . $row['date'] . '</span></div>';
            }

            $previousDate = $date1;
        }

        if ($row['type'] === "text") {

            if ($row['incoming_msg_id'] === $incoming_id) {
                $output .= '
                
                <li class="conversation-item">
                  
                    <div class="conversation-item-content">
                        <div class="conversation-item-wrapper">
                            <div class="conversation-item-box">
                                <div class="conversation-item-text">
                                    <p>' . $row['msg'] . '</p>
                                    <div class="conversation-item-time">' . $row['time'] . '</div>
                                </div>
                                <div class="conversation-item-dropdown">
                                    <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                    <ul class="conversation-item-dropdown-list">
                                        <li><a href="#" class="translate"><i class="ri-share-forward-line"></i>
                                                transferer</a></li>
                                        <li><a href="#" class="translate"><i class="ri-delete-bin-line"></i>
                                                Supprimer</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>';
            } else {
                $output .= '
                <li class="conversation-item me"> 
                    
                    <div class="conversation-item-content">
                        <div class="conversation-item-wrapper">
                            <div class="conversation-item-box">
                                <div class="conversation-item-text">
                                    <p>' . $row['msg'] .'</p>
                                    <div class="conversation-item-time">' . $row['time'] . '</div>
                                </div>
                                <div class="conversation-item-dropdown">
                                    <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                    <ul class="conversation-item-dropdown-list">
                                        <li><a href="#" class="translate"><i class="ri-share-forward-line"></i>
                                                transferer</a></li>
                                        <li><a href="#" class="translate"><i class="ri-delete-bin-line"></i>
                                                Supprimer</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>';
            }
        } else {

            $name = $row['msg'];
            $elements = explode("_", $name);
            $filename = end($elements);

            if ($row['incoming_msg_id'] === $incoming_id) {
                $output .= '                                        
                <li class="conversation-item">
                    
                    <div class="conversation-item-content">
                        <div class="conversation-item-wrapper ">
                            <div class="conversation-item-box me_file">
                                <div class="conversation-item-text">
                                    <div class="file_options_detail">
                                        <div class="head">
                                            <img src="freelancer_dashboard_assets/images/other/rar.png" alt="">
                                            <div class="name_detail">
                                                <p class="translate">' . $row['msg'] . '</p>
                                                <span>' . $row['size'] . "ko, Archive WinRAR ZIP " . '</span>
                                            </div>
                                        </div>

                                        <div class="options">
                                            <button class="open translate">Ouvrir</button>
                                            <button class="save translate"><a href="' . $row['path'] . '" download="' . $filename . '">Enregistrer</a></button>
                                        </div>

                                    </div>

                                    <div class="conversation-item-time">' . $row['time'] . '</div>
                                </div>
                                <div class="conversation-item-dropdown">
                                    <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                    <ul class="conversation-item-dropdown-list">
                                        <li><a href="#" class="translate"><i class="ri-share-forward-line"></i>
                                                Transferer</a></li>
                                        <li><a href="#" class="translate"><i class="ri-delete-bin-line"></i>
                                                Supprimer</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>';
            } else {
                $output .= '                                        
                <li class="conversation-item me">
                   
                    <div class="conversation-item-content">
                        <div class="conversation-item-wrapper ">
                            <div class="conversation-item-box me_file">
                                <div class="conversation-item-text">
                                    <div class="file_options_detail">
                                        <div class="head">
                                            <img src="freelancer_dashboard_assets/images/other/rar.png" alt="">
                                            <div class="name_detail">
                                                <p class="translate">' . $row['msg'] . '</p>
                                                <span>' . $row['size'] . "ko, Archive WinRAR ZIP " . '</span>
                                            </div>
                                        </div>

                                        <div class="options">
                                            <button class="open translate">Ouvrir</button>
                                            <button class="save translate"><a href="../Admin_Dashboard/' . $row['path'] . '" download="' . $filename . '">Enregistrer</a></button>
                                        </div>

                                    </div>

                                    <div class="conversation-item-time">' . $row['time'] . '</div>
                                </div>
                                <div class="conversation-item-dropdown">
                                    <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                    <ul class="conversation-item-dropdown-list">
                                        <li><a href="#" class="translate"><i class="ri-share-forward-line"></i>
                                                Transferer</a></li>
                                        <li><a href="#" class="translate"><i class="ri-delete-bin-line"></i>
                                                Supprimer</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
            </li>';
            }
        }
    }
} else {
    $output .= '<div class="text">Aucun message dans la discussion. Le fil s\'actualisera une fois qu\'un message sera envoyé.</div>';
}
echo $output;
