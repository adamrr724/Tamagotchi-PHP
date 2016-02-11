<?php
  require_once __DIR__.'/../vendor/autoload.php';
  require_once __DIR__.'/../src/tamagotchi.php';



  session_start();
  if(empty($_SESSION['tamagotchi-status']))
  {
    $_SESSION['tamagotchi-status'] = array();
  }

  $app = new Silex\Application();


  $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
  ));

  $app->get('/', function() use ($app){
    return $app['twig']->render('name.html.twig');
  });

  $app->post("/added", function() use ($app){
    $tammy = new Tamagotchi($_POST['name']);
    $tammy->save();
    return $app['twig']->render('added.html.twig', array('tammy' => $tammy));
  });

  $app->get("/status", function() use ($app){
    $tammyList = Tamagotchi::getAll();
    return $app['twig']->render('status.html.twig', array('tammyList' => $tammyList));
  });

  $app->post("/feed", function() use ($app){
    $tammyList = Tamagotchi::getAll();
    foreach($tammyList as $key => $tammy){
      if($tammy->getName() == $_POST['name']){
        $tammy->feed();
      }
    }
    return $app['twig']->render('status.html.twig', array('tammyList' => $tammyList));
  });

  $app->post("/play", function() use ($app){
    $tammyList = Tamagotchi::getAll();
    foreach($tammyList as $key => $tammy){
      if($tammy->getName() == $_POST['name']){
        $tammy->play();
      }
    }
    return $app['twig']->render('status.html.twig', array('tammyList' => $tammyList));
  });

  $app->post("/sleep", function() use ($app){
    $tammyList = Tamagotchi::getAll();
    foreach($tammyList as $key => $tammy){
      if($tammy->getName() == $_POST['name']){
        $tammy->sleep();
      }
    }
    return $app['twig']->render('status.html.twig', array('tammyList' => $tammyList));
  });

  $app->post("/passthetime", function() use ($app){
    $tammyList = Tamagotchi::getAll();
    Tamagotchi::passTheTime();
    return $app['twig']->render('status.html.twig', array('tammyList' => $tammyList));
  });

  $app->post("/clear", function() use ($app){
    Tamagotchi::clear();
    return $app['twig']->render('name.html.twig');
  });
  return $app;
?>
