<?php

// Short, simple, and script-y.
define("ENABLE", true);

// Require request library
require ( "request.php" );

// Load composer packages
require("../vendor/autoload.php");
// Declare password
$password = 'password';

// Declare current page and verify. Request will sanitize XSS / Directory Traversal
$view = !is_null( Request::i()->view ) && file_exists( 'endpoint/' . Request::i()->view . '.php' ) ? Request::i()->view : 'view'; // view / add / future additions

// Declare Twig
$twig = new Twig\Environment( new Twig\Loader\FilesystemLoader('template/' ), [ 'debug' => false, 'strict_variables' => true ] );

// Require endpoint
require 'endpoint/' . $view . ".php";

// Render body with endpoint encased
echo $twig->load( "body.twig" )->render( $view::run() );

// Halt execution
exit;