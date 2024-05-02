<?php

//this is my controller!

//turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require
require_once ('vendor/autoload.php');
require_once ('model/survey-data-layers.php');

//instantiate the F3 base class (F3 is fat free framework)
$f3 = Base::instance();

//Define a default route
$f3->route('GET /', function (){

    //Render a view page
    $view = new Template();
    echo $view->render('views/home.html');
});

//route for survey
$f3->route('GET|POST /survey', function ($f3)
{
    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        var_dump($_POST);
        if (!empty($_POST['name']) && !empty($_POST['box']))
        {
            $f3->set('SESSION.name', $_POST['name']);
            $f3->set('SESSION.box', $_POST['box']);
            $f3->reroute('end');
        }
    }

    //default view
    $box = getCheckBoxes();
    $f3->set('box', $box);
    $view = new Template();
    echo $view->render('views/survey.html');
});
//reroute for end page
$f3->route('GET|POST /end', function ($f3)
{

    $view = new Template();
    echo $view->render('views/end.html');
});

//run Fat Free
$f3->run();
