<?php

    switch (@parse_url($_SERVER['REQUEST_URI'])['path']) {
    case '/':
        require 'forum.php';
        break;
    case '/forum.php':
        require 'forum.php';
        break;
    case '/admin/database-function.php':
        require __DIR__.'/admin/database-function.php';
        break;
    default:
        http_response_code(404);
        exit('Not Found');
    }

?>