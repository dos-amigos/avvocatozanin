<?php

return [
    'debug' => true,

    'panel' => [
        'install' => true,
    ],

    // Maintenance mode — set to false to disable
    'maintenance' => true,
    'maintenance.password' => 'avvzanin26',

    'thumbs' => [
        'presets' => [
            'default' => ['width' => 1024, 'quality' => 80],
            'card'    => ['width' => 600,  'quality' => 80],
            'hero'    => ['width' => 1920, 'quality' => 80],
            'thumb'   => ['width' => 400,  'quality' => 80],
        ],
    ],

    // Page cache — active for all pages except /contatti (form must render dynamically)
    'cache' => [
        'pages' => [
            'active' => true,
            'ignore' => function ($page) {
                // Disable cache when maintenance is active (needs session) or for contatti (form)
                if (option('maintenance')) return true;
                return $page->id() === 'contatti';
            },
        ]
    ],

    // Routes
    'routes' => [
        // Maintenance password handler
        [
            'pattern' => 'maintenance-login',
            'method'  => 'POST',
            'action'  => function () {
                $password = get('maintenance_password');
                if ($password === option('maintenance.password')) {
                    $session = kirby()->session();
                    $session->set('maintenance_access', true);
                    go('/');
                }
                go('/?auth=failed');
            }
        ],
        // Sitemap
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

    // Hooks — maintenance gate
    'hooks' => [
        'route:before' => function ($route, $path, $method) {
            if (!option('maintenance')) return;
            // Allow panel, API, assets, and maintenance POST
            if (Str::startsWith($path, 'panel') ||
                Str::startsWith($path, 'api') ||
                Str::startsWith($path, 'media') ||
                $path === 'maintenance-login') {
                return;
            }
            // Check session
            $session = kirby()->session();
            if ($session->get('maintenance_access') === true) return;
            // Show maintenance page
            echo new Kirby\Http\Response(
                Tpl::load(kirby()->root('templates') . '/maintenance.php', [
                    'site' => site(),
                    'page' => site()->homePage(),
                ]),
                'text/html',
                503
            );
            die();
        }
    ],
];
