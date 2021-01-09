<?php

    switch (@parse_url($_SERVER['REQUEST_URI'])['path']) {
    case '/':
        require 'forum.php';
        break;
    case '/forum.php':
        require 'forum.php';
        break;
    default:
        http_response_code(404);
        exit('Not Found');
    }

?>