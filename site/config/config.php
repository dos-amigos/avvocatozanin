<?php

return [
    'debug' => true,

    'panel' => [
        'install' => true,
    ],

    'thumbs' => [
        'presets' => [
            'default' => ['width' => 1024, 'quality' => 80],
            'card'    => ['width' => 600,  'quality' => 80],
            'hero'    => ['width' => 1920, 'quality' => 80],
            'thumb'   => ['width' => 400,  'quality' => 80],
        ],
    ],

    // Page cache (exclude contact form page)
    'cache' => [
        'pages' => [
            'active' => true,
            'ignore' => function ($page) {
                return $page->intendedTemplate()->name() === 'contatti';
            }
        ]
    ],

    // Sitemap route
    'routes' => [
        [
            'pattern' => 'sitemap.xml',
            'action'  => function () {
                $pages = site()->index()->listed()->filterBy('intendedTemplate', '!=', 'error');
                $content = '<?xml version="1.0" encoding="UTF-8"?>';
                $content .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
                foreach ($pages as $p) {
                    $content .= '<url><loc>' . $p->url() . '</loc></url>';
                }
                $content .= '</urlset>';
                return new Kirby\Http\Response($content, 'application/xml');
            }
        ],
    ],
];
