<?php

require_once __DIR__ . 
'/vendor/autoload.php';

use Controller\AuthController;
use Controller\BookController;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function getFlashMessage($type) {
    if (isset($_SESSION["flash_message"][$type])) {
        $message = $_SESSION["flash_message"][$type];
        unset($_SESSION["flash_message"][$type]);
        return $message;
    }
    return null;
}

$action = $_GET["action"] ?? "login";

switch ($action) {
    case "login":
        $controller = new AuthController();
        $controller->showLogin();
        break;
    case "do_login":
        $controller = new AuthController();
        $controller->login();
        break;
    case "register":
        $controller = new AuthController();
        $controller->showRegister();
        break;
    case "do_register":
        $controller = new AuthController();
        $controller->register();
        break;
    case "logout":
        $controller = new AuthController();
        $controller->logout();
        break;
    case "dashboard":
        $controller = new BookController();
        $controller->dashboard();
        break;
    case "my_books":
        $controller = new BookController();
        $controller->myBooks();
        break;
    case "add_book":
        $controller = new BookController();
        $controller->showAddBook();
        break;
    case "do_add_book":
        $controller = new BookController();
        $controller->addBook();
        break;
    case "edit_book":
        $controller = new BookController();
        $controller->showEditBook();
        break;
    case "do_edit_book":
        $controller = new BookController();
        $controller->editBook();
        break;
    case "book_details":
        $controller = new BookController();
        $controller->showBookDetails();
        break;
    case "delete_book":
        $controller = new BookController();
        $controller->deleteBook();
        break;
    default:
        if (!isset($_SESSION["user_id"])) {
            header("Location: index.php?action=login");
        } else {
            header("Location: index.php?action=dashboard");
        }
        exit;
}

?>