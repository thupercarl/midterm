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

$f3->route('GET|POST /survey', function($f3){
    //var_dump($_POST);
    //if the form has been submitted, add the data to session
    //and send the user to the summary page

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $_SESSION['name'] = $_POST['name'];
        if(empty($_SESSION['name']))
        {
            $f3->set('errors["name"]', 'Please enter a name');
        }

        if(!empty($_POST['selection']))
        {
            $_SESSION['selection'] = implode(", ", $_POST['selection']);
        }
        else
        {
            $f3->set('errors["select"]', 'please select');
        }

        if (empty($f3->get('errors'))) {
            header('location: summary');
        }

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
