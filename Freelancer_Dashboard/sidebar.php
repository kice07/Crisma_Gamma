<div class="sidebar close">

    <a href="index.php" class="logo-details">
        <img src="freelancer_dashboard_assets/images/Favicon.png" alt="">
        <span class="logo_name">Crismawork</span>
    </a>


    <i class='bx bx-chevron-right closer'></i>

    <ul class="nav-links">
        <li class="parent_link">
            <a href="index.php">
                <i class='bx bx-grid-alt'></i>
                <span class="link_name translate">Tableau de bord</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name translate" href="index.php">Tableau de bord</a></li>
            </ul>
        </li>


        <li class="parent_link">
            <div class="iocn-link">
                <a href="job.php">
                    <i class='bx bx-briefcase-alt-2'></i>
                    <span class="link_name translate">Job</span>
                </a>
                <!-- <i class='bx bxs-chevron-down arrow'></i> -->
            </div>
            <ul class="sub-menu">
                <li><a class="link_name translate" href="job.php">Job</a></li>
                <!-- <li><a href="#" class="translate">liste de Job</a></li>
                <li><a href="create-job.php" class="translate">Poster un Job</a></li> -->
            </ul>
        </li>


        <li class="parent_link">
            <a href="freelancer_category.php">
                <i class='bx bxs-user-detail'></i>
                <span class="link_name translate">Contrat</span>
            </a>
            <ul class="sub-menu">
                <li><a class="link_name translate" href="freelancer_category.php">Contrat</a></li>
            </ul>
        </li>


        <li class="parent_link">
            <a href="chat.php">
                <i class='bx bx-chat'></i>
                <span class="link_name translate">Chat</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="chat.php">Chat</a></li>
            </ul>
        </li>


        <li class="parent_link">
            <div class="iocn-link">
                <a href="#">
                    <i class='bx bx-spreadsheet'></i>
                    <span class="link_name translate">Factures</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name translate" href="#">Factures</a></li>
                <li><a href="#" class="translate">Nouvelle facture</a></li>
                <li><a href="#" class="translate">recentes</a></li>
            </ul>
        </li>

        <li class="logout">
            <hr class="sep">
            <!-- -->
            <a href="freelancer_dashboard_assets/php_checking/logout.php?logout_id=<?php echo $_SESSION['unique_freelancer_id']; ?> " class="log_out">
                <i class='bx bx-log-out'></i>
                <span class="link_name translate">Deconnexion</span>
            </a>
        </li>

    </ul>

</div>