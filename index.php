<?php

$message_sent = false;
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['token_response'])){
    $url ='https://www.google.com/recaptcha/api/siteverify';
    $secret = '6LfXD4cdAAAAABe-I0FJJ6Fw5MMqpcYhHe_LiBYf';
    $recaptcha_response =$_POST['token_response'];
    $request=file_get_contents($url.'?secret='.$secret.'&&response='.$recaptcha_response);
    $response = json_decode($request);
    if($response->success==true && $response->score >= 0.5){
        echo '<script language="javascript">';
        echo 'alert("Merci de m\'avoir contacter, je vous répondrai le plus rapidement possible")';
        echo '</script>';
        echo "<script>setTimeout(\"location.href='index.php';\", 00)';</script>";

    }else{
        echo '<script language="javascript">';
        echo 'alert("Erreur")';
        echo '</script>';
        echo "<script>setTimeout(\"location.href='index.php';\", 00)';</script>";
    }
}
if (isset($_POST['email']) && $_POST['email'] != '') {

    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

        // submit the form

        $userName = $_POST['name'];
        $userEmail = $_POST['email'];
        $userPhone = $_POST['phone'];
        $userSubject = $_POST['subject'];
        $message = $_POST['message'];

        $to = "toufik-m@live.fr";
        $body = "Vous avez reçu un courrier ";

        $body .= "From: " . $userName . "\r\n";
        $body .= "Email: " . $userEmail . "\r\n";
        $body .= "Téléphone: " . $userPhone . "\r\n";
        $body .= "Message: " . $message . "\r\n";

        mail($to, $userSubject, $body);

        $message_sent = true;
    } else {
        $invalid_class_name = "form-invalid";
    }
}

try {
    $pdo = new PDO('mysql:host=localhost;dbname=site_perso', 'root', ''); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $req = 'SELECT * FROM projects';
    $result = $pdo->query($req);
    $projects  = $result->fetchAll(PDO::FETCH_NUM);
}catch(PDOException $e) {
    echo 'Échec lors de la connexion : ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">

    <title>Ben Meziani</title>
<script src="https://www.google.com/recaptcha/api.js?render=6LfXD4cdAAAAAJw2mPfKO16zG29bPb16GvmGi_zg"></script>

   <script>
        grecaptcha.ready(function() {
          grecaptcha.execute('6LfXD4cdAAAAAJw2mPfKO16zG29bPb16GvmGi_zg', {action: 'submit'}).then(function(token) {
              // Add your logic to submit to your backend server here.

              var response=document.getElementById('token_response');
              response.value=token;
          });
        });
  </script>
</head>

<body>
    <div class="scroll-up-btn">
        <i class="fas fa-angle-up"></i>
    </div>
    <nav class="navbar">
        <div class="max-width">
            <div class="logo">
                <a href="#">Portfo<span>lio.</span></a></div>
            <ul class="menu">
                <li><a href="#home" class="menu-btn">Accueil</a></li>
                <li><a href="#about" class="menu-btn">A propos de moi</a></li>
                <li><a href="#services" class="menu-btn">Services</a></li>
                <li><a href="#skills" class="menu-btn">Compétences</a></li>
                <li><a href="#teams" class="menu-btn">Projets</a></li>
                <li><a href="#contact" class="menu-btn">Contact</a></li>
            </ul>
            <div class="menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>

    <!-- home section start -->
    <section class="home" id="home">
        <div class="max-width">
            <div class="home-content">
                <div class="text-1">
                    Hello, je m'appelle</div>
                <div class="text-2">
                    Ben Meziani</div>
                <div class="text-3">
                    Et je suis <span class="typing"></span></div>
                <a href="#">Engagez moi !</a>
            </div>
        </div>
    </section>

    <!-- about section start -->
    <section class="about" id="about">
        <div class="max-width">
            <h2 class="title">
                A propos de moi</h2>
            <div class="about-content">
                <div class="column left">
                    <img src="images/moi.jpg" alt="Picture of me">
                </div>
                <div class="column right">
                    <div class="text">
                        Je m'appelle Ben Meziani et je suis <span class="typing-2"></span></div>
                    <p>
                        Anciennement réceptionniste en hôtellerie, je me suis reconverti au
                        métier de développeur web pour suivre ma passion de toujours. Aujourd'hui,
                    fort d'une expérience que j'ai pu acquérir sur des projets personnels et professionnels. </p><br>
                    <p>Je
                        souhaite donc trouver une entreprise pour une nouvelle expérience
                        dans le milieu professionnel du développement web. Je suis donc à la
                        recherche de l'entreprise avec laquelle je pourrai continuer à m'épanouir
                        tout en
                        apportant mon savoir-faire.
                    </p>
                    <a href="data/cv.pdf" target="_blank">Download CV</a>
                </div>
            </div>
        </div>
    </section>

    <!-- services section start -->
    <section class="services" id="services">
        <div class="max-width">
            <h2 class="title">
                Mes services</h2>
            <div class="serv-content">
                <div class="card">
                    <div class="box">
                        <i class="fas fa-paint-brush"></i>
                        <div class="text">
                            Front-end</div>
                        <p>
                            Je m'occupe de produire le design de votre site et de son intégration et respectant les maquettes prédéfinies</p>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <i class="fas fa-chart-line"></i>
                        <div class="text">
                            SEO</div>
                        <p>
                            Je m'occupe de l'optimisation de votre site et de son référencement sur les différents moteurs de recherche.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <i class="fas fa-code"></i>
                        <div class="text">
                            Back-end</div>
                        <p>
                            Je m'occupe de toute la partie serveur de votre site et également de sa base de données</p>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- skills section start -->
    <section class="skills" id="skills">
        <div class="max-width">
            <h2 class="title">
                Mes compétences</h2>
            <div class="skills-content">
                <div class="column left">
                    <div class="text">
                        Softskills:</div>
                    <p>
                        Je suis très rigoureux, autonome.
                        J'ai une solide culture web et une réelle connaissance des tendances internet.
                        Je maîtrise les principaux langages de développement web.
                    </p>
                </div>
                <div class="column right">
                    <div class="bars">
                        <div class="info">
                            <span>HTML</span>
                            <span>90%</span>
                        </div>
                        <div class="line html">
                        </div>
                    </div>
                    <div class="bars">
                        <div class="info">
                            <span>CSS</span>
                            <span>60%</span>
                        </div>
                        <div class="line css">
                        </div>
                    </div>
                    <div class="bars">
                        <div class="info">
                            <span>JavaScript</span>
                            <span>70%</span>
                        </div>
                        <div class="line js">
                        </div>
                    </div>
                    <div class="bars">
                        <div class="info">
                            <span>PHP</span>
                            <span>90%</span>
                        </div>
                        <div class="line php">
                        </div>
                    </div>
                    <div class="bars">
                        <div class="info">
                            <span>MySQL</span>
                            <span>85%</span>
                        </div>
                        <div class="line mysql">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- teams section start -->
    <section class="teams" id="teams">
        <div class="max-width">
            <h2 class="title">
                Mes projets</h2>
            <div class="carousel owl-carousel">
                <?php for($i = 0; $i < count($projects); $i++){?>
                        <?= 
                        '<div class="card">
                        <div class="box">'?>
                         <?php if ($projects[$i][2] !== 'Bientôt en ligne!') : ?>
                        <a class="link_projects" href="https://<?= $projects[$i][3]?>.mon-site-developpeur.com/" target="_blank" style="color: white;"><img src="./images/<?= $projects[$i][3]?>.png" alt=""></a>
                        <?php else : ?>
                            <img src="./images/<?= $projects[$i][3]?>.png" alt="">
                            <?php endif; ?>
                            <div class="text">
                            <?= $projects[$i][1]?></div> 
                            <?php if ($projects[$i][2] === 'Bientôt en ligne!') : ?>
                                <p>Bientôt en ligne!</p>
                            <?php else : ?>
                                <p><a class="link_projects" href="https://<?= $projects[$i][3]?>.mon-site-developpeur.com/" target="_blank" style="color: white;"><?= $projects[$i][2]?>.mon-site-developpeur.com</a></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php } ?>
            </div>
        </div>
    </section>

    <!-- contact section start -->
    <section class="contact" id="contact">
        <div class="max-width">
            <h2 class="title">
                Contactez moi</h2>
            <div class="contact-content">
                <div class="column left">
                        <div class="row">
                            <i class="fas fa-user"></i>
                            <div class="info">
                                <div class="head">
                                    Nom</div>
                                <div class="sub-title">
                                    Ben MEZIANI</div>
                            </div>
                        </div>
                        <div class="row">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="info">
                                <div class="head">
                                    Localisation</div>
                                <div class="sub-title">
                                    Paris, France</div>
                            </div>
                        </div>
                        <div class="row">
                            <i class="fas fa-envelope"></i>
                            <div class="info">
                                <div class="head">
                                    Email</div>
                                <div class="sub-title">
                                    ben.meziani.pro@gmail.com</div>
                            </div>
                        </div>
                        <div class="row">
                            <i class="fas fa-phone-alt"></i>
                            <div class="info">
                                <div class="head">
                                    Téléphone</div>
                                <div class="sub-title">
                                    +336 99 54 80 46</div>
                            </div>
                        </div>
                        <div class="row">
                            <i class="fab fa-linkedin"></i>
                            <div class="info">
                                <div class="head">
                                    LinkedIn</div>
                                <div class="sub-title">
                                    <a href="https://www.linkedin.com/in/ben-meziani/" target="_blank">linkedin.com/in/ben-meziani/</a> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column right">
                        <div class="text">
                            Pour m'envoyer un message</div>
                        <form action="index.php" method="post" name="contact">
                            <input type="hidden" id="token_response" name="token_response">
                            <div class="fields">
                                <div class="field name">
                                    <input type="text" name="name" placeholder="Votre nom" value="" required>
                                </div>
                                <div class="field email">
                                    <input <?= $invalid_class_name ?? "" ?>type="email" placeholder="Votre email" name="email" value="" required>
                                </div>
                            </div>
                            <div class="field phone">
                                <input type="tel" id="phone" name="phone" id="phone" placeholder="Numéro de téléphone" required>
                            </div>
                            <div class="field subject">
                                <input type="text" placeholder="Sujet" name="subject" value="" required>
                            </div>
                            <div class="field">
                                <textarea name="message" placeholder="Votre message" rows="10" cols="50" required></textarea>
                            </div>
                            <div class="field textarea">
                                <!-- Due to more textarea, I got an error so I changed the tag name of this textarea into changeit. -->
                                <changeit cols="30" rows="10" placeholder="Message.." required></changeit>
                            </div>
                            <div class="button">
                                <button type="submit" value="Envoyer !">Envoyer</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </section>

    <!-- footer section start -->
    <footer>
        <span>Created By <a href="#">Ben Meziani</a> | <span class="far fa-copyright"></span> 2021 All rights
            reserved.</span>
    </footer>

    <!-- Somehow I got an error, so I comment the script tag, just uncomment to use -->

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="js/app.js"></script>

</body>

</html>