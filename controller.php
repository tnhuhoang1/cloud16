<?php

    switch (@parse_url($_SERVER['REQUEST_URI'])['path']) {
    case '/':
        require 'forum.php';
        break;
    case '/forum.php':
        require 'forum.php';
        break;
    case '/database/database-function.php':
        require __DIR__.'/database/database-function.php';
        break;
    case '/database/database-connection.php':
        require __DIR__.'/database/database-connection.php';
        break;
    default:
        http_response_code(404);
        exit('Not Found');
    }

?>