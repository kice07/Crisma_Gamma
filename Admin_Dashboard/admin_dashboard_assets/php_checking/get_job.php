<?php
include("../../../config.php");
if ($_POST['action'] == "getjobs") {
    $answer = '';
    $id = $_POST['id'];
    $job_query = mysqli_query($conn, "SELECT * FROM jobs WHERE id='$id'");
    $infos = mysqli_fetch_assoc($job_query);
    if ($job_query) {
        $answer = '<h3>' . htmlspecialchars($infos['title'], ENT_QUOTES, 'UTF-8') . '</h3>
                    <!-- details -->
                    <div class="job_details">
                        <div class="detail">
                            <i class="bx bx-dollar"></i>
                            <span>' . htmlspecialchars($infos['salary'], ENT_QUOTES, 'UTF-8') . '</span>
                        </div>

                        <div class="detail">
                            <i class="ai-briefcase"></i>
                            <span>' . htmlspecialchars($infos['experience'], ENT_QUOTES, 'UTF-8') . ' experience</span>
                        </div>

                        <div class="detail">
                            <i class="ai-clock"></i>
                            <span>' . htmlspecialchars($infos['job_type'], ENT_QUOTES, 'UTF-8') . '</span>
                        </div>
                    </div>

                    <!-- skills -->
                    <div class="section">
                        <p class="title translate">Competence</p>
                        <div class="skills_list">';
        $skills = explode(";", $infos['skills']);
        foreach ($skills as $element) {
            $answer .= '<span>' . htmlspecialchars($element, ENT_QUOTES, 'UTF-8') . '</span>';
        }

        $answer .= '</div>
                    </div>

                    <!-- language -->
                    <div class="section">
                        <p class="title translate">Langue</p>
                        <div class="lang_list">
                            <span>FR</span>
                            <span>ANG</span>
                            <span>ALL</span>
                        </div>
                    </div>

                    <!-- experience -->
                    <div class="section">
                        <p class="title translate">Description</p>
                        <div>' .$infos['content'] . '</div>
                    </div>';

        echo $answer;
    }
} else {
    $id = $_POST['id'];
    $job_query = mysqli_query($conn, "DELETE FROM jobs WHERE id='$id'");
    if ($job_query) {
        echo "success";
    } else {
        echo mysqli_error($conn);
    }
}
