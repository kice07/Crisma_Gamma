<div class="navbar">
    <a href="index.php" class="logo"><img src="freelancer_dashboard_assets/images/crislogo.png" alt=""></a>
    <div class="middle">
        <ul>
            <a href="job.php">
                <li class="translate">Liste d'offres</li>
            </a>
            <a href="portfolio.php">
                <li class="translate">Portfolio</li>
            </a>
            <a href="invoices.php">
                <li class="translate">Factures</li>
            </a>
            <a href="offer_list.php">
                <li class="translate">Candidatures</li>
            </a>
            <a href="full_chat.php">
                <li class="translate">Chat</li>
            </a>
        </ul>
    </div>
    <div class="end">
        <img src=<?php echo (strtolower(substr($_SESSION['language'], 0, 2)) == "fr") ? "https://www.worldometers.info/img/flags/fr-flag.gif" : "https://www.worldometers.info/img/flags/us-flag.gif" ?> alt="" onclick="changeFlag(this)">

        <div class="counter">
            <i class='bx bx-bell'></i>
            <span>2</span>
        </div>

        <div class="counter">
            <i class='bx bx-calendar'></i>
        </div>

        <a href="profile.php" class="profile"><img src=<?php echo ($_SESSION['image']  == '') ? "freelancer_dashboard_assets/images/freelancer/no_user.png" : "freelancer_dashboard_assets/images/freelancer/" . $_SESSION['image'] ?> style="border:2px solid white" alt=""></a>
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

            xhr.open("POST", "freelancer_dashboard_assets/php_checking/change_flag.php", true);
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

            xhr.open("POST", "freelancer_dashboard_assets/php_checking/change_flag.php", true);
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