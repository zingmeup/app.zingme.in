<?php
function dataCleaner($dirty){
  $clean=htmlspecialchars(strip_tags(addslashes(trim(filter_var($dirty, FILTER_SANITIZE_STRING)))));
  return $clean;
}

function sendMail(){
 $to = "zing.j23@gmail.com";
 $subject = "Appathon Query";
 $message ="<html>
 <head>
 <title></title>
 </head>
 <body>
 Dear Sir,<br><br>
 ".$GLOBALS['args']['query']."<br><br>

 <strong>".$GLOBALS['args']['name']."<br>".$GLOBALS['args']['phone']."<br>".$GLOBALS['args']['email']."<br></strong>

 </body>
 </html>";

 $headers  = 'MIME-Version: 1.0' . "\r\n";
 $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 $headers .= 'From: '.$GLOBALS['args']['email']."\r\n".
 'Reply-To: '.$GLOBALS['args']['email']."\r\n" .
 'X-Mailer: PHP/' . phpversion();
 $retval = mail ($to,$subject,$message,$headers);
 if( $retval == true ) {
 }else {
  echo "Message could not be sent...";
}
}

function getArgs(){
  $argsMissing=false;
  if (isset($_POST['name'])&&!empty($_POST['name'])
    &&isset($_POST['email'])&&!empty($_POST['email'])
    &&isset($_POST['phone'])&&!empty($_POST['phone'])
    &&isset($_POST['query'])&&!empty($_POST['query'])) {
    $GLOBALS['args']['name']=dataCleaner($_POST['name']);
  $GLOBALS['args']['email']=dataCleaner($_POST['email']);
  $GLOBALS['args']['phone']=dataCleaner($_POST['phone']);
  $GLOBALS['args']['query']=dataCleaner($_POST['query']);
}else{
  $argsMissing=true;
}
return !$argsMissing;
}

if(isset($_POST['submit'])){
  if(getArgs()){
    sendMail();
  }else {
  }
}else {
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Appathon</title>

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
    crossorigin="anonymous">
  <link type="text/css" rel="stylesheet" href="/css/materialize.css" media="screen,projection" />
  <link type="text/css" rel="stylesheet" href="/css/style.css" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Appathon is Departmental event of TechInvent Chandigarh University. You have to make android app based on given problem statements">
  <meta name="keywords" content="Appathon, Departmental event, event, Chandigarh University, app, google, dsc, Bharat Agarwal, techInvent, android, problem statements">
  <meta name="author" content="Bharat Agarwal">
  <meta name="copyright" content="&copy; 2019 Appathon, TechInvent and DSC">
  <link rel="apple-touch-icon" sizes="57x57" href="/images/icons/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="/images/icons/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="/images/icons/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="/images/icons/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="/images/icons/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="/images/icons/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="/images/icons/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="/images/icons/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="/images/icons/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192" href="/images/icons/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/images/icons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="/images/icons/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/images/icons/favicon-16x16.png">
  <link rel="manifest" href="./manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="/images/icons/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta content="yes" name="apple-touch-fullscreen">
  <meta name="apple-mobile-web-app-status-bar-style" content="#ffffff">
</head>

<body>
  <div class="navigationclass">
    <header class="navbar-fixed">
      <nav class="white">
        <div class="container">
          <div class="nav-wrapper">
            <div class="row">
              <div class="col s12">
                <a href="#!" data-target="slide-out" class="sidenav-trigger black-text left hide-on-medium-and-up button-collapse"><i
                    class="material-icons">menu</i></a>
                <a class="brand-logo"><img src="./images/logo.png" alt="dsc small logo"></a>
                <ul class="right hide-on-med-and-down">
                  <li>
                    <a href="#home" class="black-text">Home</a>
                  </li>
                  <li>
                    <a href="#about" class="black-text">About</a>
                  </li>

                  <li>
                    <a href="#problemStatement" class="black-text">Problem Statement</a>
                  </li>
                  <li>
                    <a href="#prize" class="black-text">Prizes</a>
                  </li>
                  <li>
                    <a href="#rules" class="black-text">Rules</a>
                  </li>

                  <li>
                    <a href="#contact" class="black-text">Contact</a>
                  </li>
                  <li>
                    <a href="http://techinvent.cuchd.in/login.php" class="black-text sidenav-close">Register</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </nav>
    </header>
    <ul id="slide-out" class="sidenav">
      <li>
        <div class="user-view" style='height: 150px;'>
          <div class="background ">
            <img src="./images/techgig.png" class="imgCU" alt="techInvent">
          </div>
        </div>
      </li>
      <li>
        <a href="#home" class="black-text sidenav-close">Home</a>
      </li>
      <li>
        <a href="#about" class="black-text sidenav-close">About</a>
      </li>

      <li>
        <a href="#problemStatement" class="black-text sidenav-close">Problem Statement</a>
      </li>
      <li>
        <a href="#prize" class="black-text sidenav-close">Prizes</a>
      </li>
      <li>
        <a href="#rules" class="black-text sidenav-close">Rules</a>
      </li>
      <li>
        <a href="#contact" class="black-text sidenav-close">Contact</a>
      </li>
      <li>
        <a href="http://techinvent.cuchd.in/login.php" class="black-text sidenav-close">Register</a>
      </li>
    </ul>
  </div>
  <div id="home" class="parallax-container">
    <div class="parallax"><img src="images/back.png" class="back hide-on-med-and-down" alt="back for Desktop"></div>
    <div class="parallax"><img src="images/back-mob.png" class="back hide-on-large-only" alt="back for mobile"></div>
    <a href="http://techinvent.cuchd.in/login.php" class="btn btn-large register grad5 waves-effect waves-light bordered hide-on-med-and-down"> REGISTER NOW! </a>
    <a href="http://techinvent.cuchd.in/login.php" class="btn btn-large register grad4 waves-effect waves-light bordered  hide-on-large-only"> REGISTER NOW! </a>
  </div>

  <section id="about" style="padding-top: 10px" class="center section">
    <div class="row">
      <div class="col s12 m7 center-align">
        <div class="card bordered" style="background-color:#0070c0">
          <div class="card-content white-text center">
            <span class="card-title" style="font-weight: bold;font-size: 30px">About</span>
            <p class="white black-text bordered" style="padding:10px">
              Appathon is a Android application Development Hack-a-thon Organized by Developer Student Club, Computer
              Science and Engineering Department Chandigarh University<br> This year, We bring to you the perfect
              opportunity to participate and show your potential and limitless creativity to solve real-world problems
              in the best magic CSE student can do!
              <br>
              You will be solving a problem that you generally face in your colleges/ homes/ friends/ community.
              <br>
              Problem Statements may be abstract and generic.
              <br>
              Build Android Native apps with Java/Kotlin and Flutter.
              <br>
              <strong>05 April, 2019 Time: 10 AM to 6 PM</strong>
            </p>

          </div>
        </div>
      </div>
      <div class="col s12 m5 center-align container" style="padding-top: 10px">
        <div class="row center">
          <div class="col s4 m6 l4">
            <img class="responsive-img back" src="./images/java.png" alt="Technology Java">
          </div>
          <div class="col s4 m6 l4">
            <img class="responsive-img back" src="./images/flutter.png" alt="Technology Flutter">
          </div>
          <div class="col s4 m6 l4">
            <img class="responsive-img back" src="./images/kot.png" style="padding-top:15px;" alt="Technology kot">
          </div>
        </div>
        <div>
          <img src="images/coolerandy.jpg" class="responsive-img back" class="Cool android">
        </div>
      </div>
    </div>
  </section>
  <section class="section" id="problemStatement">
    <div class="row">
      <div class="col s12 m5">
        <div class="card green hoverable bordered">
          <div class="card-content center bordered net">
            <span class="card-title anoncolor bordered white-text" style="font-weight: bold">Problem Statements</span>
            <p>
              <h5>Revealing in..</h5>
              <div style="padding:20px;" class="white-text">
                <div class="row">
                  <div class="col s3">
                    <div id="days" class="makeBold"></div>
                  </div>
                  <div class="col s3">
                    <div id="hours" class="makeBold">:</div>
                  </div>
                  <div class="col s3">
                    <div id="mini" class="makeBold">:</div>
                  </div>
                  <div class="col s3">
                    <div id="sec" class="makeBold">:</div>
                  </div>
                </div>
                <div class="row">
                  <div class="col s3">Days</div>
                  <div class="col s3">Hours</div>
                  <div class="col s3">Minutes</div>
                  <div class="col s3">Seconds</div>
                </div>
              </div>
            </p>
          </div>
        </div>
      </div>
      <div class="col s12 m7">
        <div class=" ordered">
          <div class="center bordered net">
            <p>
              <div class="carousel">
                <a class="carousel-item modal-trigger" href="#one">
                  <div class="card-panel hoverable pad-50 teal">
                    <span class="white-text">
                      <i class="material-icons">lock</i>
                    </span>
                  </div>
                </a>
                <a class="carousel-item modal-trigger" href="#two">
                  <div class="card-panel horizontal pad-50 green">
                    <span class="white-text">
                      <i class="material-icons">lock</i>
                    </span>
                  </div>
                </a>
                <a class="carousel-item modal-trigger" href="#three">
                  <div class="card-panel hoverable pad-50 blue">
                    <span class="white-text">
                      <i class="material-icons">lock</i>
                    </span>
                  </div>
                </a>
                <a class="carousel-item modal-trigger" href="#four">
                  <div class="card-panel hoverable pad-50 deep-orange">
                    <span class="white-text">
                      <i class="material-icons">lock</i>
                    </span>
                  </div>
                </a>
                <a class="carousel-item modal-trigger" href="#five">
                  <div class="card-panel hoverable pad-50 purple">
                    <span class="white-text">
                      <i class="material-icons">lock</i>
                    </span>
                  </div>
                </a>
              </div>
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="row" id="prize">
    <div class="col s12 m6" style="max-height:60% !important;min-height:60% !important">
      <div class="card-panel bordered hoverable z-depth-2" id="prize">
        <h2 class="prize-title center">Prizes Pool</h2>
        <div class="center te">
          <img src="images/cash.png" id="cash" alt="cash back">
          <h4 class="centered blue-grey-text text-darken-3">₹XX,000</h4>
        </div>
        <div class="row">
          <div class="col s4">
            <img src="images/coffee.png" class="responsive-img left" alt="coffee">
          </div>
          <div class="col s4" style="margin-top: 14px">
            <img src="images/cer.png" class="responsive-img center" alt="certificate">
          </div>
          <div class="col s4">

            <img src="./images/gift1.png" class="responsive-img " alt="more swags">
          </div>

        </div>
      </div>
    </div>
    <div class="col s12 m6" style="max-height:60% !important;min-height:60% !important">
      <div class="card-panel bordered hoverable z-depth-2" id="rank">
        <div class="row">
          <div class="col s12 center">
            <img src="./images/1st.png" class="responsive-img back" alt="" style="min-width: 15%;max-width: 25%;" alt="1st place">
            <h5>₹X,000</h5>
          </div>
          <div class="col s12 m6">
            <img class="left responsive-img back" src="./images/2nd.png" alt="" style="min-width: 45%;max-width: 50%;"
              alt="2nd place">
            <h5 class="left">₹X,000</h5>
          </div>
          <div class="col s12 m6">
            <img class="right responsive-img back" src="./images/3rd.png" alt="" style="min-width: 40%;max-width: 50%;"
              alt="3rd place">
            <h5 class="right">₹X,000</h5>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix pad-30 pad-20-bottom hide-on-med-and-down"></div>
  <div class="row" id="rules">
    <div class="col s12 m6 ">
      <div class="card bordered hoverable grey darken-3">
        <div class="card-content white-text center">
          <span class="card-title" style="font-weight: bold;font-size: 30px">Rules</span>
          <ul class="collection white black-text bordered" style="padding:10px">
            <li class="collection-item">Apply as Individual or as Team (2-4 members).</li>
            <li class="collection-item">Build everything from the scratch, not WebView nor WebApp.</li>
            <li class="collection-item">Build your apps based on problem statements (to be disclosed).</li>
            <li class="collection-item">Bring your own laptops with softwares Required</li>
            <li class="collection-item">Last date for applying is 26-March</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col s12 m6">
      <div class="card bordered hoverable  grey darken-3">
        <div class="card-content white-text center">
          <span class="card-title" style="font-weight: bold;font-size: 30px">Judging criteria</span>
          <ul class="collection white black-text bordered" style="padding:10px">
            <li class="collection-item"><span class="badge">20 Points</span>Design Standards User Experience</li>
            <li class="collection-item"><span class="badge">20 Points</span>Idea and Innovation</li>
            <li class="collection-item"><span class="badge">20 Points</span>Relavance to the problem statements</li>
            <li class="collection-item"><span class="badge">20 Points</span>Features and functionality</li>
            <li class="collection-item"><span class="badge">20 Points</span>Pitch/Presentation</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row" id="contact">
    <div class="col s12 m6">
      <div class="row">
        <div class="col s12">
          <h4 class="center">Faculty Coordinator</h4>
        </div>
        <div class="col s12 m6 ">
          <div class="card-panel hoverable inherit-padding grad2 bordered z-depth-1">
            <div class="row valign-wrapper">
              <div class="col s4">
                <img src="./images/jasneet.jpeg" style="margin-top:5px" class="circle responsive-img" alt="Jasneet kaur">
              </div>
              <div class="col s8">
                <span class="white-text">
                  <h5>Jasneet Kaur</h5>
                  <p style="font-size:12px">jasneete7747@cumail.in</p>
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="col s12 m6">
          <div class="card-panel hoverable inherit-padding grad3 bordered z-depth-1">
            <div class="row valign-wrapper">
              <div class="col s4">
                <img src="./images/anjum.jpeg" style="margin-top:5px" class="circle responsive-img" alt="anjum md.">
              </div>
              <div class="col s8">
                <span class="white-text">
                  <h5>Anjum Md.</h5>
                  <p style="font-size:12px">anjummohdaslam.cse@cumail.in</p>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
          <h4 class="center">Student Coordinator</h4>
        </div>
        <div class="col s12 m6">
          <div class="card-panel hoverable inherit-padding grad5 bordered z-depth-1">
            <div class="row valign-wrapper">
              <div class="col s4">
                <img src="./images/deepak.jpg" style="margin-top:5px" class="circle responsive-img" alt="Deepak Yadav DSC lead by Google">
              </div>
              <div class="col s8">
                <span class="white-text">
                  <h5>Deepak Yadav</h5>
                  <p style="font-size:12px">cu.16bcs2082@gmail.com</p>
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="col s12 m6">
          <div class="card-panel hoverable inherit-padding grad4 bordered z-depth-1">
            <div class="row valign-wrapper">
              <div class="col s4">
                <img src="./images/bhaskar.jpeg" style="margin-top:5px" class="circle responsive-img" alt="Bhaskar Kumar">
              </div>
              <div class="col s8">
                <span class="white-text">
                  <h5>Bhaskar Kumar</h5>
                  <p style="font-size:12px">cu.16bcs1613@gmail.com</p>
                </span>
              </div>
            </div>
          </div>
        </div>

        <div class="col s12">
          <img src="images/fillers.png" class="responsive-img" alt="fillers">
        </div>
      </div>
    </div>
    <div class="col s12 m6">
      <div class="card bordered hoverable">
        <div class="card-content">
          <div class="card-title center titleShow">Contact us</div>
          <div class="row">
            <form class="col s12" method="POST">
              <div class="row">
                <div class="input-field col s12">
                  <input id="name" name="name" type="text" class="validate">
                  <label for="name" class="blue-text">Name</label>
                </div>
                <div class="input-field col s12">
                  <input id="email" name="email" type="email" class="validate">
                  <label for="email" class="yellow-text text-darken-3">Email</label>
                </div>
                <div class="input-field col s12">
                  <input id="telephone" name="phone" type="tel" class="validate">
                  <label for="telephone" class="red-text">Phone</label>
                </div>
                <div class="input-field col s12">
                  <textarea id="query" name="query" class="materialize-textarea"></textarea>
                  <label for="query" class="green-text">Query</label>
                </div>
                <div class="col s12 center">
                  <button type="submit" name="submit" value="submit" class="btn btn-large center grad5 waves-effect waves-light bordered">Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="divider"></div>
  <div class="clearfix pad-30 pad-20-bottom hide-on-med-and-down"></div>
  <section class="container">
    <div class="row">
      <div class="col s12">

        <div class="row">
          <div class="col s12 m4">
            <img class="responsive-img he " src="./images/culogo.png" alt="Chandigarh University">
          </div>
          <div class="col s12 m4">
            <img class="responsive-img he" src="./images/DSC_badge.jpg" alt="DSC badge">

          </div>
          <div class="col s12 m4">
            <img class="responsive-img he" src="./images/techgig.png" class="techInvent Logo">
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="divider"></div>


  <div id="contactresponse" class="modal">
    <div class="modal-content">
      <h4>Thank you your name,</h4>
      <p>Your Query is recorded with us, we will reply back to you soon</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
  </div>

<!--

    <div id="contactresponse" class="modal" style="display: block;">
      <div class="modal-content">
        <h4>Thank you your name,</h4>
        <p>Your Query is recorded with us, we will reply back to you soon</p>
      </div>
      <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
      </div>
    </div> -->


  <!-- Models For question-->
  <div id="one" class="modal">
    <div class="modal-content">
      <h4>Problem Statement 1</h4>
      <p>To be disclosed</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
  </div>
  <div id="two" class="modal">
    <div class="modal-content">
      <h4>Problem Statement 2</h4>
      <p>To be disclosed</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
  </div>
  <div id="three" class="modal">
    <div class="modal-content">
      <h4>Problem Statement 3</h4>
      <p>To be disclosed</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
  </div>
  <div id="four" class="modal">
    <div class="modal-content">
      <h4>Problem Statement 4</h4>
      <p>To be disclosed</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
  </div>
  <div id="five" class="modal">
    <div class="modal-content">
      <h4>Problem Statement 5</h4>
      <p>To be disclosed</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
  </div>


  <footer class="page-footer grad3">
    <div class="footer-copyright">
      <div class="container">
      © 2019 Copyright Appathon & DSC
    </div>
  </footer>

  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.js"></script>
  <script src="./js/main.js"></script>
  <script src="./js/timer.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-135750518-2"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-135750518-2');
    </script>
</body>

</html>
