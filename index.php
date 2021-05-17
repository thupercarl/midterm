<?php

//this is my controller for the midterm project
ini_set('display_errors',1);
error_reporting(E_ALL);

//Start a session
session_start();

//require autoload file
require_once('vendor/autoload.php');

//instantiate fat-free
$f3 = Base::instance();

//define default route
$f3->route('GET /', function(){
    $_SESSION = array();
    //display the main page
    $view = new Template();
    echo $view->render('views/home.html');
});

$f3->route('GET|POST /survey', function(){
    //var_dump($_POST);
    //if the form has been submitted, add the data to session
    //and send the user to the summary page

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $_SESSION['name'] = $_POST['name'];

        $_SESSION['selection'] = implode(", ", $_POST['selection']);
        header('location: summary');
    }

    //Display the survey page
    $view = new Template();
    echo $view->render('views/survey.html');
});

$f3->route('GET /summary', function(){

    //Display the summary page
    $view = new Template();
    echo $view->render('views/summary.html');
});

//Run Fat-Free
$f3->run();
