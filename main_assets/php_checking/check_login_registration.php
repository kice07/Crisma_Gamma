<?php
session_start();
include_once "../../config.php";

require 'vendor/autoload.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';





// SIGNUP
use LDAP\Result;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_POST['action'] == "signup") {
    if ($_POST['side'] == "freelanceer") {


        $fname = mysqli_real_escape_string($conn, $_POST['name']);
        $lname = mysqli_real_escape_string($conn, $_POST['surname']);
        $email2 = mysqli_real_escape_string($conn, $_POST['email']);
        $country = mysqli_real_escape_string($conn, $_POST['country']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $password2 = mysqli_real_escape_string($conn, $_POST['confirm_password']);

        if (!empty($fname) && !empty($lname) && !empty($country) && !empty($email2) && !empty($password) && !empty($password)) {

            if (preg_match('/^[^0-9]{1,60}$/', $fname) && preg_match('/^[^0-9]{1,60}$/', $lname) && preg_match('/^[^0-9]{1,60}$/', $country)) {

                if (filter_var($email2, FILTER_VALIDATE_EMAIL)) {
                    $sql = mysqli_query($conn, "SELECT * FROM freelancer WHERE email = '{$email2}'");
                    if (mysqli_num_rows($sql) > 0) {
                        echo "$email2 - Cet utilisateur existe déjà";
                    } else {
                        if (preg_match("/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{1,15}$/", $password)) {

                            if ($password === $password2) {

                                $ran_id = rand(time(), 100000000);
                                $status = "En ligne";
                                $encrypt_pass = password_hash($password, PASSWORD_BCRYPT);
                                $insert_query = mysqli_query($conn, "INSERT INTO freelancer (id, nom, prenom, email, password, status, pays, token)
                                    VALUES ({$ran_id}, '{$fname}','{$lname}', '{$email2}', '{$encrypt_pass}' '{$status}', '{$location}', '{$ran_id}')");
                                if ($insert_query) {
                                    $_SESSION['unique_freelancer_id'] = $ran_id;
                                    $sql = mysqli_query($conn, "UPDATE freelancer SET status = 'En ligne' WHERE id ='{$_SESSION['unique_freelancer_id']}'");
                                    $token = $ran_id;
                                    $mail = new PHPMailer();

                                    try {
                                        //Server settings  
                                        $mail->SMTPDebug = 0;                      //Enable verbose debug output
                                        $mail->isSMTP();                                       //Send using SMTP
                                        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                                        $mail->Username   = 'ivanehouman5@gmail.com';                     //SMTP username
                                        $mail->Password   = 'tqdeildainebjlad';                               //SMTP password
                                        $mail->SMTPSecure = 'tsl';           //Enable implicit TLS encryption
                                        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                                        //Recipients
                                        $mail->setFrom('ivanehouman5@gmail.com');
                                        $mail->addAddress($email2);

                                        //Content
                                        $mail->isHTML(true);                                  //Set email format to HTML
                                        $mail->Subject = 'no reply';
                                        $mail->Body    = 'Voici le lien de verification de vôtre compte <b><a href="http://crismawork.com/Freelancer_Dashboard/freelancer.php?verification=' . $token . '&agbrd=' . $ran_id . '">http://crismawork/Freelancer_Dashboard/index.php?verification=' . $token . '</a></b>';

                                        $mail->send();

                                        echo "success";
                                    } catch (Exception $e) {

                                        echo "email non envoyé";
                                    }
                                } else {
                                    echo "Erreur survenue";
                                }
                            } else {
                                echo "Les mots de passe doivent être les même";
                            }
                        } else {
                            echo "Le mot de passe doit contenir des lettres(minuscule et majuscule) , des chiffres et des symbols";
                        }
                    }
                } else {
                    echo "$email n'est pas valide!";
                }
            } else {
                echo "Entrez des noms valides et sans chiffres ";
            }
        } else {
            echo "Tous les champs sont requis";
        }
    } else {


        $fname = mysqli_real_escape_string($conn, $_POST['name']);
        $email2 = mysqli_real_escape_string($conn, $_POST['email']);
        $size = mysqli_real_escape_string($conn, $_POST['taille']);
        $location = mysqli_real_escape_string($conn, $_POST['location']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

        if (!empty($fname) && !empty($size) && !empty($field) && !empty($confirm_password) && !empty($email2) && !empty($password)) {

            if (preg_match('/^[^0-9]{1,60}$/', $fname) && preg_match('/^[^0-9]{1,60}$/', $location)) {

                if (preg_match('/^-?\d+(\.\d+)?$/', $size)) {
                    if (filter_var($email2, FILTER_VALIDATE_EMAIL)) {
                        $sql = mysqli_query($conn, "SELECT * FROM company WHERE email = '{$email2}'");
                        if (mysqli_num_rows($sql) > 0) {
                            echo "$email2 - Cet utilisateur existe déjà";
                        } else {
                            if (preg_match("/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{1,15}$/", $password)) {
                                if ($password == $confirm_password) {


                                    $ran_id = rand(time(), 200000000);
                                    $status = "En ligne";
                                    $encrypt_pass = password_hash($password, PASSWORD_BCRYPT);
                                    $insert_query = mysqli_query($conn, "INSERT INTO company (id, name, pass, email, status, token, location, employe)
                                    VALUES ({$ran_id}, '{$fname}','{$encrypt_pass}', '{$email2}', '{$status}', '{$ran_id}', '{$location}', '{$size}')");
                                    if ($insert_query) {
                                        $_SESSION['unique_company_id'] = $ran_id;
                                        $sql = mysqli_query($conn, "UPDATE company SET status = 'En ligne' WHERE id ='{$_SESSION['unique_company_id']}'");
                                        $token = $ran_id;
                                        $mail = new PHPMailer();

                                        try {
                                            //Server settings  
                                            $mail->SMTPDebug = 0;                      //Enable verbose debug output
                                            $mail->isSMTP();                                       //Send using SMTP
                                            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                                            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                                            $mail->Username   = 'ivanehouman5@gmail.com';                     //SMTP username
                                            $mail->Password   = 'tqdeildainebjlad';                               //SMTP password
                                            $mail->SMTPSecure = 'tsl';           //Enable implicit TLS encryption
                                            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                                            //Recipients
                                            $mail->setFrom('ivanehouman5@gmail.com');
                                            $mail->addAddress($email2);

                                            //Content
                                            $mail->isHTML(true);                                  //Set email format to HTML
                                            $mail->Subject = 'no reply';
                                            $mail->Body    = 'Voici le lien de verification de vôtre compte <b><a href="http://crismawork.com/Admin_Dashboard/index.php?verification=' . $token . '&agbd=' . $ran_id . '">http://crismawork.com/Admin_Dashboard/index.php?verification=' . $token . '</a></b>';

                                            $mail->send();


                                            echo "success";
                                        } catch (Exception $e) {

                                            echo "email non envoyé";
                                        }
                                    } else {
                                        echo "Erreur survenue";
                                    }
                                } else {
                                    echo "Les deux mots de passe sont differeents";
                                }
                            } else {
                                echo "Le mot de passe doit contenir des lettres(minuscule et majuscule) , des chiffres et des symbols";
                            }
                        }
                    } else {
                        echo "$email n'est pas valide!";
                    }
                } else {
                    echo "la taille n'est pas valide!";
                }
            } else {
                echo "Entrez des noms valides et sans chiffres ";
            }
        } else {
            echo "Tous les champs sont requis";
        }
    }
} else {

    // =================================== LOGIN

    if ($_POST["side"] == "freelancer") {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        if (!empty($email) && !empty($password)) {
            $sql = mysqli_query($conn, "SELECT * FROM freelancer WHERE email = '{$email}'");
            if (mysqli_num_rows($sql) > 0) {
                $row = mysqli_fetch_assoc($sql);
                // $user_pass = md5($password);
                $enc_pass = $row['password'];
                if (password_verify($password, $enc_pass)) {
                    $status = "En ligne";
                    $sql2 = mysqli_query($conn, "UPDATE freelancer SET status = '{$status}' WHERE id = {$row['id']}");
                    if ($sql2) {
                        $_SESSION['unique_freelancer_id'] = $row['id'];
                        $sql = mysqli_query($conn, "UPDATE freelancer SET status = 'En ligne' WHERE id ='{$_SESSION['unique_freelancer_id']}'");
                        echo "success";
                    } else {
                        echo "Erreur , veuillez reessayer";
                    }
                } else {
                    echo "mot de passe incorrect";
                }
            } else {
                echo "$email - Cet email n'existe pas";
            }
        } else {
            echo "Tous les champs sont requis";
        }
    } else {

        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        if (!empty($email) && !empty($password)) {
            $sql = mysqli_query($conn, "SELECT * FROM company WHERE email = '{$email}'");
            if (mysqli_num_rows($sql) > 0) {
                $row = mysqli_fetch_assoc($sql);
                // $user_pass = md5($password);
                $enc_pass = $row['pass'];
                if (password_verify($password, $enc_pass)) {
                    $status = "En ligne";
                    $sql2 = mysqli_query($conn, "UPDATE company SET status = '{$status}' WHERE id = {$row['id']}");
                    if ($sql2) {
                        $_SESSION['unique_company_id'] = $row['id'];
                        $sql = mysqli_query($conn, "UPDATE company SET status = 'online' WHERE id ='{$_SESSION['unique_company_id']}'");
                        echo "success";
                    } else {
                        echo "Erreur , veuillez reessayer";
                    }
                } else {
                    echo "Email ou mot de passe incorrect";
                }
            } else {
                echo "$email - Cet email n'existe pas";
            }
        } else {
            echo "Tous les champs sont requis";
        }
    }
}
