<?php
if (isset($_GET['side'])) {
    $side = $_GET['side'];
} else {
    header("Location: index.html");
}

?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> CrismaWork | login and signup</title>
    <!-- CSS -->
    <link rel="stylesheet" href="main_assets/css/login_registration.css">

    <link rel="icon" href="main_assets/images/crislogo.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <?php
    if ($side == "freelancer") {

    ?>

        <section class="container forms freelancer">
            <!-- login Form -->
            <div class="bigParent login">
                <div class="bloc">
                    <div class="left-side">
                        <img src="main_assets/images/back/woman.png" alt="">
                        <p>Bon retour sur Crismawork</p>
                    </div>
                    <div class="form ">
                        <div class="form-content">
                            <header>Connexion</header>
                            <div class="error connexion">
                                <p></p>
                            </div>
                            <form action="#" method="POST">
                                <div class="field input-field">
                                    <input type="email" placeholder="Email" name="email" class="input">
                                </div>
                                <div class="field input-field">
                                    <input type="password" placeholder="Mot de passe" name="password" class="password">
                                    <i class='bx bx-hide eye-icon'></i>
                                </div>
                                <div class="form-link">
                                    <a href="#" class="forgot-pass">Mot de passe oublié?</a>
                                </div>
                                <div class="field button-field">
                                    <button class="sendLogin">Connexion</button>
                                </div>
                            </form>
                            <div class="form-link">
                                <span>Pas de comptes? <a href="#" class="link signup-link" onclick="showSignUp(this)">Inscrivez
                                        vous</a></span>
                            </div>
                        </div>
                        <div class="line"></div>
                        <div class="media-options">
                            <a href="#" class="field facebook">
                                <!-- <i class='bx bxl-linkedin-square'></i> -->
                                <i class='bx bxl-linkedin'></i>
                                <span>Se connecter via linkedIn</span>
                            </a>
                        </div>
                        <!-- <div class="media-options">
                        <a href="#" class="field google">
                            <img src="assets2/images/google.png" alt="" class="google-img">
                            <span>Se connecter avec google</span>
                        </a>
                    </div> -->
                    </div>
                </div>
            </div>

            <!-- Signup Form -->
            <div class="bigParent signup">
                <div class="bloc">
                    <div class="left-side">
                        <img src="main_assets/images/back/man.png" alt="">
                        <p>Bienvenu sur CrismaWork</p>
                    </div>
                    <div class="form">
                        <div class="form-content">
                            <header>Inscription</header>
                            <div class="error Inscription">
                                <p></p>
                            </div>
                            <div class="success">
                                <p>Inscription reussie ,
                                    veuillez consilter votre boîte mail pour activer votre compte</p>
                            </div>
                            <form action="#" method="POST">
                                <div class="field input-field">
                                    <input type="text" placeholder="Nom" name="name" class="input">
                                </div>

                                <div class="field input-field">
                                    <input type="text" placeholder="Prenom" name="surname" class="input">
                                </div>

                                <div class="field input-field">
                                    <input type="email" placeholder="Email" name="email" class="input">
                                </div>
                                <div class="field input-field">
                                    <input type="text" placeholder="pays" name="country" class="country">
                                </div>
                                <div class="field input-field">
                                    <input type="password" placeholder="Mot de passe" name="password" class="password">
                                    <i class='bx bx-hide eye-icon'></i>
                                </div>
                                <div class="field input-field">
                                    <input type="password" placeholder="Confirmer mot de passe" name="confirm_password" class="password">
                                    <i class='bx bx-hide eye-icon'></i>
                                </div>
                                <div class="field button-field">
                                    <button class="sendSignup">Inscription</button>
                                </div>
                            </form>
                            <div class="form-link">
                                <span>Vous avez déjà un compte? <a href="#" class="link login-link" onclick="showLogin(this)">Connexion</a></span>
                            </div>
                        </div>
                        <div class="line"></div>
                        <div class="media-options">
                            <a href="#" class="field facebook">
                                <i class='bx bxl-linkedin'></i>
                                <span>Connexion via linkedIn</span>
                            </a>
                        </div>
                        <!-- <div class="media-options">
                        <a href="#" class="field google">
                            <img src="assets2/images/google.png" alt="" class="google-img">
                            <span>Connexion via Google</span>
                        </a>
                    </div> -->
                    </div>
                </div>

            </div>

        </section>

    <?php

    } else {

    ?>
        <section class="container forms comapny">
            <div class="compParent login">
                <div class="bloc">
                    <div class="left-side">
                        <img src="main_assets/images/back/team.png" alt="">
                        <p>Bon retour sur Crismawork</p>
                    </div>
                    <div class="form ">
                        <div class="form-content">
                            <header>Connexion</header>
                            <div class="error connexion">
                                <p></p>
                            </div>
                            <form action="#">
                                <div class="field input-field">
                                    <input type="email" placeholder="Email" name="email" class="input">
                                </div>
                                <div class="field input-field">
                                    <input type="password" placeholder="Mot de passe" name="password" class="password">
                                    <i class='bx bx-hide eye-icon'></i>
                                </div>
                                <div class="form-link">
                                    <a href="#" class="forgot-pass">Mot de passe oublié?</a>
                                </div>
                                <div class="field button-field">
                                    <button class="sendLogin">Connexion</button>
                                </div>
                            </form>
                            <div class="form-link">
                                <span>Pas de comptes? <a href="#" class="link signup-link" onclick="showSignUp(this)">Inscrivez vous</a></span>
                            </div>
                        </div>
                        <div class="line"></div>
                        <div class="media-options">
                            <a href="#" class="field facebook">
                                <!-- <i class='bx bxl-linkedin-square'></i> -->
                                <i class='bx bxl-linkedin'></i>
                                <span>Se connecter via linkedIn</span>
                            </a>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Signup Form -->
            <div class="compParent signup">
                <div class="bloc">
                    <div class="left-side">
                        <img src="main_assets/images/back/C_woman.png" alt="">
                        <p>Bienvenu sur CrismaWork</p>
                    </div>
                    <div class="form">
                        <div class="form-content">
                            <header>Inscription</header>
                            <div class="error Inscription">
                                <p></p>
                            </div>
                            <div class="success">
                                <p>Inscription reussie ,
                                    veuillez consilter votre boîte mail pour activer votre compte</p>
                            </div>
                            <form action="#">
                                <div class="field input-field">
                                    <input type="text" placeholder="Nom" name="name" class="input">
                                </div>
                                <div class="field input-field">
                                    <input type="email" placeholder="Email" name="email" class="input">
                                </div>
                                <div class="field input-field">
                                    <input type="text" placeholder="siege" name="location" class="input">
                                </div>
                                <div class="field input-field">
                                    <input type="text" placeholder="Taille" name="taille" class="input">
                                </div>
                                <div class="field input-field">
                                    <input type="password" placeholder="Mot de passe" name="password" class="password">
                                    <i class='bx bx-hide eye-icon'></i>
                                </div>
                                <div class="field input-field">
                                    <input type="password" placeholder="Confirmer mot de passe" name="confirm_password" class="password">
                                    <i class='bx bx-hide eye-icon'></i>
                                </div>
                                <div class="field button-field">
                                    <button class="sendSignup">Inscription</button>
                                </div>
                            </form>
                            <div class="form-link">
                                <span>Vous avez déjà un compte? <a href="#" class="link login-link" onclick="showLogin(this)">Connexion</a></span>
                            </div>
                        </div>
                        <div class="line"></div>
                        <div class="media-options">
                            <a href="#" class="field facebook">
                                <i class='bx bxl-linkedin'></i>
                                <span>Connexion via linkedIn</span>
                            </a>
                        </div>

                    </div>
                </div>
            </div>

        </section>


    <?php
    }

    ?>


    <!-- JavaScript -->
    <script>
        const side = "<?php echo $_GET['side'] ?>"
        // var urlParams = new URLSearchParams(window.location.search);


        // var side = urlParams.get('side');

        //SIGNUP_LOGIN


        const loginForm = document.querySelector('.login form');
        const signupForm = document.querySelector('.signup form');

        const sendLogin = document.querySelector('.login .sendLogin');
        const sendSignup = document.querySelector('.signup .sendSignup');

        const successMessage = document.querySelector('.signup .success');
        const errorTextLogin = document.querySelector('.login .connexion');
        const errorTextSignup = document.querySelector('.signup .Inscription');


        signupForm.onsubmit = (e) => {
            e.preventDefault();
        }


        sendSignup.onclick = () => {
            let xhr = new XMLHttpRequest();
            let formData = new FormData(signupForm)

            formData.append('side', side);
            formData.append('action', "signup");

            xhr.open("POST", "main_assets/php_checking/check_login_registration.php", true);
            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let data = xhr.response;
                        if (data === "success") {
                            successMessage.style.display = "block";
                        } else {
                            errorTextSignup.firstElementChild.textContent = data;
                            errorTextSignup.style.display = "block";


                        }
                    }
                }
            }

            xhr.send(formData);
        }




        loginForm.onsubmit = (e) => {
            e.preventDefault();
        }

        sendLogin.onclick = () => {

            let xhr = new XMLHttpRequest();

            // Ajoute une variable à la requête POST
            let formData2 = new FormData(loginForm);
            formData2.append('side', side);
            formData2.append('action', "login");

            xhr.open("POST", "main_assets/php_checking/check_login_registration.php", true);
            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let data = xhr.response;
                        if (data === "success") {
                            if (side == "freelancer") {
                                location.href = "Freelancer_Dashboard/index.php"

                            } else {
                                location.href = "Admin_Dashboard/index.php"
                            }

                        } else {
                            errorTextLogin.firstElementChild.textContent = data;
                            errorTextLogin.style.display = "block";

                        }
                    }
                }
            }

            xhr.send(formData2);
        }
    </script>
    <script src="main_assets/js/Login_registration.js"></script>
</body>

</html>