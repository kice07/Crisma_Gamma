<?php

while ($row = mysqli_fetch_assoc($query)) {
    $sql2 = "SELECT * FROM message WHERE (incoming_msg_id = {$row['id']}
                OR outgoing_msg_id = {$row['id']}) AND (outgoing_msg_id = {$outgoing_id} 
                OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
    $query2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($query2);
    (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result = "Aucun message";
    (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
    if (isset($row2['outgoing_msg_id'])) {
        ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "vous: " : $you = "";
    } else {
        $you = "";
    }
    ($row['status'] == "Hors ligne") ? $offline = "offline" : $offline = "";


    $sql3 = "SELECT state FROM message WHERE outgoing_msg_id = {$row['id']} AND state = 'unread'";
    $unread = mysqli_num_rows(mysqli_query($conn, $sql3));


    if (isset($row2['time'])) {
        if ($unread == 0) {
            $output .= '<li  onclick="createChat(this)">
                            <a href="#" data-conversation="#conversation-' . $row['id'] . '" statut="' . $row['status'] . '" perso_id="' . $row["id"] . '">
                                <img class="content-message-image" src="../Freelancer_Dashboard/freelancer_dashboard_assets/images/freelancer/' . $row['image'] . '" alt="">
                                <span class="content-message-info">
                                    <span class="content-message-name">' . $row['nom'] . " " . $row['prenom'] . '</span>
                                    <span class="content-message-text translate">' . $you . $msg . '</span>
                                </span>
                                <span class="content-message-more">
                                    
                                    
                                    <span class="content-message-time">' . $row2['time'] . '</span>
                                </span>
                            </a>
                     </li>';
        } else {
            $output .= '<li  onclick="createChat(this)">
                            <a href="#" data-conversation="#conversation-' . $row['id'] . '" statut="' . $row['status'] . '" perso_id="' . $row["id"] . '">
                                <img class="content-message-image" src="../Freelancer_Dashboard/freelancer_dashboard_assets/images/freelancer/' . $row['image'] . '" alt="">
                                <span class="content-message-info">
                                    <span class="content-message-name">' . $row['nom'] . " " . $row['prenom'] . '</span>
                                    <span class="content-message-text translate">' . $you . $msg . '</span>
                                </span>
                                <span class="content-message-more">
                                    <span class="content-message-unread">' . $unread . '</span>
                                    
                                    <span class="content-message-time">' . $row2['time'] . '</span>
                                </span>
                            </a>
                      </li>';
        }
    } else {
      
        $output .= '<li  onclick="createChat(this)">
                        <a href="#" data-conversation="#conversation-' . $row['id'] . '" statut="' . $row['status'] . '" perso_id="' . $row["id"] . '">
                            <img class="content-message-image" src="../Freelancer_Dashboard/freelancer_dashboard_assets/images/freelancer/' . $row['image'] . '" alt="">
                            <span class="content-message-info">
                                <span class="content-message-name">' . $row['nom'] . " " . $row['prenom'] . '</span>
                                <span class="content-message-text translate">' . $you . $msg . '</span>
                            </span>
                            <span class="content-message-more">

                                
                                <span class="content-message-time"></span>
                            </span>
                        </a>
                   </li>';
    }
}
