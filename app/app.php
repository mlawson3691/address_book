<?php
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/Contact.php';
    require_once __DIR__.'/../src/Address.php';

    session_start();
    if (empty($_SESSION['list_of_contacts'])) {
        $_SESSION['list_of_contacts'] = array();
    }

    $app = new Silex\Application();
    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    $app->get('/', function() use ($app) {
        return $app['twig']->render('contacts.html.twig', array('contacts' => Contact::getAll()));
    });

    $app->post('/create_contact', function() use ($app) {
        $newAddress = new Address($_POST['street'], $_POST['city'], $_POST['state'], $_POST['zip']);
        $newContact = new Contact($_POST['name'], $_POST['number'], $newAddress);
        $newContact->save();
        return $app['twig']->render('create_contact.html.twig', array('contact' => $newContact));
    });

    $app->post('/delete_contacts', function() use ($app) {
        Contact::deleteAll();
        return $app['twig']->render('delete_contacts.html.twig');
    });

    $app->post('/search_contacts', function() use ($app) {
        $contacts_matching_search = array();
        if ($_POST['searchType'] == 'name') {
            foreach (Contact::getAll() as $contact) {
                $name = $contact->getName();
                if (stripos($name, $_POST['search']) !== false) {
                    array_push($contacts_matching_search, $contact);
                }
            }
        } elseif ($_POST['searchType'] == 'number') {
            foreach (Contact::getAll() as $contact) {
                $number = $contact->getNumber();
                if (stripos($number, $_POST['search']) !== false) {
                    array_push($contacts_matching_search, $contact);
                }
            }
        } elseif ($_POST['searchType'] == 'address') {
            foreach (Contact::getAll() as $contact) {
                $address = $contact->getAddress();
                if (stripos($address->getStreet(), $_POST['search']) !== false) {
                    array_push($contacts_matching_search, $contact);
                } elseif (stripos($address->getCity(), $_POST['search']) !== false) {
                    array_push($contacts_matching_search, $contact);
                } elseif (stripos($address->getState(), $_POST['search']) !== false) {
                    array_push($contacts_matching_search, $contact);
                } elseif (stripos($address->getZip(), $_POST['search']) !== false) {
                    array_push($contacts_matching_search, $contact);
                }
            }
        }
        return $app['twig']->render('search_contacts.html.twig', array('results' => $contacts_matching_search));
    });

    return $app;
?>
