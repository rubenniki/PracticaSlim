<?php

$base = __DIR__ . '/../app/';

$folders = [
    'lib',
    '/models/',
    '/controllers/',
];

foreach($folders as $f)
{
    foreach (glob($base . "$f/*.php") as $filename)
    {
        require $filename;
    }
}

?>