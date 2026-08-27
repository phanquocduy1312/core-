<?php

return [
    // Hosts allowed inside an <iframe src="..."> when saving page builder content.
    // Anything else is stripped by PageHtmlSanitizer — never add a host you do
    // not trust to embed, since the iframe still shares the page's origin policy.
    'allowed_iframe_hosts' => [
        'www.youtube.com',
        'www.youtube-nocookie.com',
        'player.vimeo.com',
        'www.google.com',
    ],
];
