<?php
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/Contact.php';

    session_start();
    if (empty($_SESSION['list_of_contacts'])) {
        $_SESSION['list_of_contacts'] = array();
        $person = new Contact('Bob', '111-111-1111', '111 One Lane Portland, OR 11111');
        $person->save();
    }

    $app = new Silex\Application();
    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    $app->get('/', function() use ($app) {
        $allContacts = Contact::getAll();
        return $app['twig']->render('contacts.html.twig', array('contacts' => $allContacts));
    });

    return $app;
?>
