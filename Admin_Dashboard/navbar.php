<div class="navbar">
    <a class="logo" href="index.php"><img src="admin_dashboard_assets/images/crislogo2.png" alt=""></a>
    <div class="middle">
        <ul>
            <a href="freelancer.php">
                <li class="translate">Liste de freelancer</li>
            </a>
            <a href="offer_list.php">
                <li class="translate">Offres postées</li>
            </a>

            <a href="chat.php">
                <li class="translate">Chat</li>
            </a>
        </ul>
    </div>
    <div class="end">
        <img src=<?php echo (strtolower(substr($_SESSION['language'], 0, 2)) == "fr") ? "https://www.worldometers.info/img/flags/fr-flag.gif" : "https://www.worldometers.info/img/flags/us-flag.gif" ?> alt="" onclick="changeFlag(this)">
        <div class="counter">
            <i class='bx bx-chat'></i>
            <span>2</span>
        </div>

        <div class="counter">
            <i class='bx bx-bell'></i>

        </div>

        <a href="profile.php" class="profile" ><img src=<?php echo ($_SESSION['picture']  == '') ? "admin_dashboard_assets/images/Building-bro.png" : "admin_dashboard_assets/images/company/" . $_SESSION['picture'] ?> 
        style="border:2px solid white" alt=""></a>
    </div>
</div>

<script>
    //==========NAVBAR
    const links = document.querySelectorAll('.navbar .middle a');
    links.forEach(link => {
        link.addEventListener('click', () => {
            links.forEach(other => {
                if (!(other === link)) {
                    other.style.color = "#19202b";
                }
            })
            link.style.color = "#fe6c4c";
        })

    })

    function changeFlag(flag) {
        if ((flag.src).substring((flag.src).length - 11) == 'fr-flag.gif') {


            let xhr = new XMLHttpRequest();

            xhr.open("POST", "admin_dashboard_assets/php_checking/change_flag.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let data = xhr.response;
                        if (data === "success") {
                            flag.src = "https://www.worldometers.info/img/flags/us-flag.gif"
                        } else {
                            console.log(data);
                        }

                    }
                }
            }
            xhr.send('new_lang=en');
        } else {
            let xhr = new XMLHttpRequest();

            xhr.open("POST", "admin_dashboard_assets/php_checking/change_flag.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let data = xhr.response;
                        if (data === "success") {
                            flag.src = "https://www.worldometers.info/img/flags/fr-flag.gif"
                        } else {
                            console.log(data);
                        }

                    }
                }
            }
            xhr.send('new_lang=fr');

        }
    }
</script>