<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />

    <title>Esen_Chat</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link href="css/style.css" rel="stylesheet" />
    <!-- This part is responsible for the script that will swap the sections it uses jquery-3 -->
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
  </head>
  <body >
    <?php
    session_start();
    require_once 'UserController.php';
    ?>
    <div class="hero_area">
      <header class="header_section">
        <div class="container-fluid">
          <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" href="index.php">
              <span>
                ESEN
              </span>
            </a>

            <div class="navbar-collapse" id="">
              <div
                class="d-none d-lg-flex ml-auto flex-column flex-lg-row align-items-center mt-3">
                <form class="form-inline mb-3 mb-lg-0 " method="post">
                <?php if (!empty($_SESSION['user_id'])) { ?>
                <button type="submit" name="Quit" class="btn btn-light">Logout</button>
                <?php
                }
                ?>
                <?php
                if (isset($_POST["Quit"]))
                {
                session_destroy();
                header('Location: index.php');
                exit;
                }
                ?>
                </form>
                <ul class="navbar-nav  mr-5">
                  <li class="nav-item mr-5">
                  <li class="nav-item mr-5">
                  <?php if (!empty($_SESSION['user_id'])) { ?>
                  <a class="nav-link" href="Profil.php">
                  <span>Profil</span>
                  </a>
                  <?php } else { ?>
                  <a class="nav-link" href="Login.php">
                  <span>Login</span>
                  </a>
                  <?php } ?>
                  </li>         
                </ul>
              </div>

              <div class="custom_menu-btn">
                <button onclick="openNav()">
                  <span class="s-1"> </span>
                  <span class="s-2"> </span>
                  <span class="s-3"> </span>
                </button>
              </div>
              <div id="myNav" class="overlay">
              <div class="overlay-content">
              <a href="index.php">Home</a>
              <?php if (!empty($_SESSION['user_id'])) { ?>
                  <a class="nav-link" href="Profil.php">
                      <span>Profil</span>
                  </a>
                  <?php if ($verif==true) { ?>
                      <a class="nav-link" href="Dashboard.php">
                          <span>Dashboard</span>
                      </a>
                  <?php } else { ?>
                      <a class="nav-link" href="Forum.php">
                          <span>Forum Page</span>
                      </a>
                  <?php } ?>
                  <a class="nav-link" href="Chat.php">
                      <span>Chat</span>
                  </a>
              <?php } else { ?>
                  <a class="nav-link" href="Login.php">
                      <span>Login</span>
                  </a>
              <?php } ?>
              </div>
              </div>
            </div>
          </nav>
        </div>
      </header>
      <section class=" slider_section position-relative">
        <div class="container">
          <div
            id="carouselExampleControls"
            class="carousel slide"
            data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div class="slider_item-box">
                  <div class="slider_item-container">
                    <div class="slider_item-detail">
                      <h1>
                        #ESEN, We Invest in Intelligence
                      </h1>
                      <p>
                        L'ESEN est plus qu'une école... c'est un état d'esprit!
                      </p>
                      <div>
                        <a href="https://www.esen.tn/portail/">
                          more
                        </a>
                      </div>
                    </div>
                    <div class="slider_item-imgbox">
                      <img src="images/banner4 .png" alt="" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="carousel-item">
                <div class="slider_item-box">
                  <div class="slider_item-container">
                    <div class="slider_item-detail">
                      <h1>
                        Nourrie d'un esprit d'innovation et d'ouverture
                      </h1>
                      <p>
                        ESEN se caractérise par 

                        son interdisciplinarité et Sa créativité et Son rôle social
                      </p>
                      <div>
                        <a href="https://www.esen.tn/portail/">
                          more
                        </a>
                      </div>
                    </div>
                    <div class="slider_item-imgbox">
                      <img src="images/pc-banner2.png" alt="" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="carousel-item">
                <div class="slider_item-box">
                  <div class="slider_item-container">
                    <div class="slider_item-detail">
                      <h1>
                        Depuis sa création en 2004
                      </h1>
                      <p>
                        ESEN a Affirmer un positionnement unique dans la formation de futures élites du domaine de l'économie numérique.
                      </p>
                      <div>
                        <a href="https://www.esen.tn/portail/">
                          more
                        </a>
                      </div>
                    </div>
                    <div class="slider_item-imgbox">
                      <img src="images/pc-banner3.png" alt="" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <a
          class="carousel-control-prev"
          href="#carouselExampleControls"
          role="button"
          data-slide="prev">
          <span class="sr-only">Previous</span>
        </a>
        <a
          class="carousel-control-next"
          href="#carouselExampleControls"
          role="button"
          data-slide="next">
          <span class="sr-only">Next</span>
        </a>
      </section>
    </div>


    <section class="about_section layout_padding">
      <div class="container">
        <h2 class="text-uppercase">
          Nos parcours
        </h2>
      </div>

      <div class="container">
        <div class="about_card-container layout_padding2-top">
          <div class="about_card">
            <div class="about-detail">
              <div class="about_img-container">
                <div class="about_img-box">
                <img src="images/bi3.png" alt="" />
                </div>
              </div>
              <div class="card_detail-ox">
                <h4>
                  Business Intelligence
                </h4>
                <p>
                  La formation BI en BC vise à former des diplômés capables de concevoir et déployer des systèmes d'aide à la décision et de gestion de connaissances pour aider les décideurs à prendre des décisions éclairées en analysant les données de l'entreprise.
                </p>
              </div>
            </div>
          </div>
          <div class="about_card">
            <div class="about-detail">
              <div class="about_img-container">
                <div class="about_img-box">
                  <img src="images/BIS.png" alt="" />
                </div>
              </div>
              <div class="card_detail-ox">
                <h4>
                  Business Information System
                </h4>
                <p>
                  Le parcours BIS en BC forme des diplômés opérationnels dans les Technologies des SI des entreprises avec des compétences en gouvernance et management des SI, ainsi qu'une compréhension globale du domaine informatique et managérial.
                </p>
              </div>
            </div>
          </div>
          <div class="about_card">
            <div class="about-detail">
              <div class="about_img-container">
                <div class="about_img-box">
                  <img src="images/ebus4.png" alt="" />
                </div>
              </div>
              <div class="card_detail-ox">
                <h4>
                  E-Business
                </h4>
                <p>
                  Le parcours E-Business en BC forme des professionnels capables de gérer des projets E-Business et d'identifier les opportunités offertes par la transformation digitale, grâce à des compétences en management, informatique et stratégie.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="who_section">
      <div class="container who_container">
        <div class="who_img-box">
          <img src="images/education-transparent-background-21.png" alt="" />
        </div>
        <div class="who_deail-box">
          <h2>
            Qui sommes nous?
          </h2>
          <p>
            L'ESEN de l'UMA est un établissement d'enseignement supérieur spécialisé dans l'économie numérique, offrant des licences et des mastères en E-Business, Business Intelligence, Information System, Data Science, Veille et Intelligence Compétitive et Contrôle de Gestion Digitalisé. L'école est agile et capable de répondre aux changements constants dans le domaine de la formation en économie numérique.
          </p>
          <div>
            <a>Read More</a>
          </div>
        </div>
      </div>
    </section>



    <section class="feature_section layout_padding">
      <div class="container">
        <h2 class="text-uppercase">
          Nos Chiffres
        </h2>
      </div>
      <div class="">
        <div class="feature_card-container layout_padding2">
          <div class="feature_card">
            <div class="feature_img-container">
              <div class="feature_img-box">
                <img src="images/guidance.png" alt="" />
              </div>
            </div>
            <div class="feature_detail-box">
              <h4>
                Parcours
              </h4>
              <p>
                L'université ESEN offre 10 parcours différents dans lesquels les étudiants peuvent étudier. Chaque parcours est conçu pour offrir une formation de qualité et répondre aux besoins du marché de l'emploi. 
              </p>
            </div>
          </div>
          <div class="feature_card">
            <div class="feature_img-container">
              <div class="feature_img-box">
                <img src="images/female.png" alt="" />
              </div>
            </div>
            <div class="feature_detail-box">
              <h4>
                Enseignants
              </h4>
              <p>
                L'Université ESEN compte 70 enseignants qui sont très compétents et variés dans leurs domaines respectifs. Chaque enseignant apporte sa propre expertise et expérience à la table.
              </p>
            </div>
          </div>
          <div class="feature_card">
            <div class="feature_img-container">
              <div class="feature_img-box">
                <img src="images/handshake.png" alt="" />
              </div>
            </div>
            <div class="feature_detail-box">
              <h4>
                Partenaires
              </h4>
              <p>
                L'université ESEN a 15 partenaires de renom, y compris des entreprises, des universités et des organisations de recherche. Ces partenaires offrent des opportunités de stages et des bourses.
              </p>
            </div>
          </div>
          <div class="feature_card">
            <div class="feature_img-container">
              <div class="feature_img-box">
                <img src="images/graduated.png" alt="" />
              </div>
            </div>
            <div class="feature_detail-box">
              <h4>
                Etudiants
              </h4>
              <p>
                L'université ESEN compte actuellement 900 étudiants inscrits dans divers domaines, tels que la gestion, la finance, la technologie de l'information et les sciences sociales. 
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="contact_section">
  <div class="container d-flex justify-content-center">
    <h2 class="text-uppercase">
      Get in touch
    </h2>
  </div>
  <div class="container-fluid layout_padding-top">
    <div class="row">
      <div class="col-md-6">
        <div class="col-md-10 offset-md-2">
          <div class="contact_img-box">
            <img src="images/form-img.jpg" alt="" />
          </div>
        </div>
      </div>
      <div class="col-md-6 form_bg px-0">
        <div class="col-md-10 px-0">
          <form method="post">
            <div class="contact_form-container">
              <div>
                <div>
                  <input type="text" placeholder="Name" name="name" required />
                </div>
                <div>
                  <input type="email" placeholder="Email" name="email" required />
                </div>
                <div>
                  <input type="text" placeholder="Phone Number" name="phone" />
                </div>
                <div>
                  <textarea placeholder="Message" class="message_input" name="message" required></textarea>
                </div>
                <div class="mt-3 d-flex justify-content-end">
                  <button type="submit" name="submit">
                    Send
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

    <section class="info_section layout_padding">
      <div class="container info_content">
        <div>
          <div class="row">
            <div class="col-md-4">
              <div class="d-flex">
                <h5>
                  Contact
                </h5>
              </div>
              <div class="d-flex ">
                <ul>
                  <li>
                    <a href="https://www.google.com/maps/place/ESEN+Manouba/@36.8078603,10.0714706,17z/data=!4m5!3m4!1s0x12fd2d8cf72265cb:0x7fc41ab7e1b5bd62!8m2!3d36.8075155!4d10.0731547?hl=en-US">
                      Adresse
                    </a>
                  </li>
                  <li>
                    <a href="">
                      Email
                    </a>
                  </li>
                  <li>
                    <a href="">
                      Tél
                    </a>
                  </li>
                  <li>
                    <a href="">
                       Fax
                    </a>
                  </li>
                  <li>
                    <a href="https://www.esen.tn/portail/">
                      Site
                    </a>
                  </li>
                </ul>
                <ul class="ml-3 ml-md-5">
                  <li>
                    <a href="">
                      Manouba CP 2010 
                    </a>
                  </li>
                  <li>
                    <a href="">
                      contact@esen.tn 
                    </a>
                  </li>
                  <li>
                    <a href="">
                      +216 70 526 343
                    </a>
                  </li>
                  <li>
                    <a href="">
                      +216 70 526 385
                    </a>
                  </li>
                  <li>
                    <a href="">
                      https://www.esen.tn/portail/
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-md-4">
              <div class="d-flex">
                <h5>
                  Nos Clubs
                </h5>
              </div>
              <div class="d-flex ">
                <ul>
                  <li>
                    <a href="https://www.esen.tn/portail/club/apollo-esen-7.html">
                      Appolo Esen
                    </a>
                  </li>
                  <li>
                    <a href="https://www.esen.tn/portail/club/aspire-esen-6.html">
                      Aspire Esen
                    </a>
                  </li>
                  <li>
                    <a href="https://www.esen.tn/portail/club/elite-council-esen-entourage-12.html">
                      Elite Council 
                    </a>
                  </li>
                  <li>
                    <a href="https://www.esen.tn/portail/club/enactus-esen-2.html">
                      Enactus Esen
                    </a>
                  </li>
                  <li>
                    <a href="https://www.esen.tn/portail/club/esen-android-club-1.html">
                      Esen Android
                    </a>
                  </li>
                </ul>
                <ul class="ml-3 ml-md-5">
                  <li>
                    <a href="https://www.esen.tn/portail/club/esen-hive-club-11.html">
                      Esen Hive
                    </a>
                  </li>
                  <li>
                    <a href="https://www.esen.tn/portail/club/joker-esen-3.html">
                      Joker Esen
                    </a>
                  </li>
                  <li>
                    <a href="https://www.esen.tn/portail/club/startup-nation-esen-5.html">
                      Esen Startup Nation
                    </a>
                  </li>
                  <li>
                    <a href="">
                      Esen Microsoft
                    </a>
                  </li>
                  <li>
                    <a href="">
                      Club Sportif
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-md-4">
              <div class="d-flex">
                <h5>
                  Liens Rapides
                </h5>
              </div>
              <div class="d-flex ">
                <ul>
                  <li>
                    <a href="https://www.esen.tn/ePFE/">
                      Accès ePFE
                    </a>
                  </li>
                  <li>
                    <a href="https://www.esen.tn/portail/page/reglement-interne-54.html">
                      Bibliothèque
                    </a>
                  </li>
                  <li>
                    <a href="http://www.biruni.tn/cgi-bin/gw_2009_4_3/chameleon?lng=fr&inst=77">
                      Biruni
                    </a>
                  </li>
                  <li>
                    <a href="https://www.google.com/maps/place/ESEN+Manouba/@36.8078603,10.0714706,17z/data=!4m5!3m4!1s0x12fd2d8cf72265cb:0x7fc41ab7e1b5bd62!8m2!3d36.8075155!4d10.0731547?hl=en-US">
                      Géolocalisation
                    </a>
                  </li>
                  <li>
                    <a href="https://www.esen.tn/portail/club-events.html">
                      Activités des clubs
                    </a>
                  </li>
                </ul>
                <ul class="ml-3 ml-md-5">
                  <li>
                    <a href="https://www.esen.tn/portail/page/partenariats-6.html">
                      Partenariat
                    </a>
                  </li>
                  <li>
                    <a href="https://www.esen.tn/portail/homepage.html">
                      Enseignants
                    </a>
                  </li>
                  <li>
                    <a href="https://www.esen.tn/portail/page/notre-equipe-9.html">
                      Notre équipe
                    </a>
                  </li>
                  <li>
                    <a href="https://www.esen.tn/portail/page/guide-lmd-de-letudiant-51.html">
                      Guide LMD
                    </a>
                  </li>
                  <li>
                    <a href="https://www.esen.tn/portail/page/documents-de-scolarite-77.html">
                      Documents de scolarité
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div
          class="d-flex flex-column flex-lg-row justify-content-between align-items-center align-items-lg-baseline>
          <div class="social-box">
            <a href="https://www.facebook.com/esenien">
              <img src="images/fb.png" alt="" />
            </a>

            <a href="https://twitter.com/ESEN66569607">
              <img src="images/twitter.png" alt="" />
            </a>
            <a href="https://tn.linkedin.com/school/esenien/">
              <img src="images/linkedin1.png" alt="" />
            </a>
            <a href="https://www.youtube.com/@esen-ecolesuperieuredecono6485">
              <img src="images/instagram1.png" alt="" />
            </a>
          </div>
          <div class="form_container mt-5">
            <form action="">
              <label for="subscribeMail">
                FEEDBACK
              </label>
              <input
                type="email"
                placeholder="Give us your feedback"
                id="subscribeMail"
              />
              <button type="submit">
                Send
              </button>
            </form>
          </div>
        </div>
      </div>
    </section>

    <section class="container-fluid footer_section">
      <p>
        &copy; 2023 All Rights Reserved.
        <a>ESEN, We Invest in Intelligence</a>
      </p>
    </section>
    
    <script>
      function openNav() {
        document.getElementById("myNav").classList.toggle("menu_width");
        document
          .querySelector(".custom_menu-btn")
          .classList.toggle("menu_btn-style");
      }
    </script>
  </body>
</html>
