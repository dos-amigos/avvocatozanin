<?php

/**
 * Router for PHP built-in server.
 * Replaces .htaccess rewrite rules for local development.
 */

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$file = __DIR__ . $path;

// Block dotfiles
if (preg_match('/(^|\/)\./', $path)) {
    return false;
}

// Block text files in content folder
if (preg_match('#^/content/.*\.(txt|md|mdown)$#', $path)) {
    require __DIR__ . '/index.php';
    return true;
}

// Media files: publish on first access (Kirby media API workaround for PHP built-in server)
if (!is_file($file) && preg_match('#^/media/(pages|site|users)/#', $path)) {
    require __DIR__ . '/kirby/bootstrap.php';
    $kirby = new Kirby;
    $response = null;

    if (preg_match('#^/media/pages/(.+)/([a-f0-9]+-\d+)/(.+)$#', $path, $m)) {
        $response = Kirby\Cms\Media::link($kirby->page($m[1]), $m[2], $m[3]);
    } elseif (preg_match('#^/media/site/([a-f0-9]+-\d+)/(.+)$#', $path, $m)) {
        $response = Kirby\Cms\Media::link($kirby->site(), $m[1], $m[2]);
    } elseif (preg_match('#^/media/users/([^/]+)/([a-f0-9]+-\d+)/(.+)$#', $path, $m)) {
        $response = Kirby\Cms\Media::link($kirby->user($m[1]), $m[2], $m[3]);
    }

    if ($response instanceof Kirby\Http\Response) {
        $response->send();
        return true;
    }
}

// Serve existing static files
if ($path !== '/' && is_file($file)) {
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

    // Media files: serve via PHP to avoid Windows file locking
    if (str_starts_with($path, '/media/')) {
        $mimeTypes = [
            'jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'png' => 'image/png',
            'gif' => 'image/gif', 'webp' => 'image/webp', 'svg' => 'image/svg+xml',
            'mp4' => 'video/mp4', 'webm' => 'video/webm', 'ogg' => 'video/ogg',
            'mov' => 'video/quicktime', 'pdf' => 'application/pdf',
            'js' => 'application/javascript', 'mjs' => 'application/javascript',
            'css' => 'text/css', 'json' => 'application/json',
            'woff' => 'font/woff', 'woff2' => 'font/woff2',
            'ttf' => 'font/ttf', 'eot' => 'application/vnd.ms-fontobject',
            'ico' => 'image/x-icon', 'map' => 'application/json',
        ];
        $mime = $mimeTypes[$ext] ?? mime_content_type($file);
        $size = filesize($file);

        header("Content-Type: $mime");
        header('Cache-Control: public, max-age=86400');

        // Range support for video streaming
        if (in_array($ext, ['mp4', 'webm', 'ogg', 'mov'])) {
            $start = 0;
            $end = $size - 1;
            header('Accept-Ranges: bytes');

            if (isset($_SERVER['HTTP_RANGE'])) {
                preg_match('/bytes=(\d+)-(\d*)/', $_SERVER['HTTP_RANGE'], $m);
                $start = intval($m[1]);
                if (!empty($m[2])) $end = intval($m[2]);
                header('HTTP/1.1 206 Partial Content');
                header("Content-Range: bytes $start-$end/$size");
            }

            $length = $end - $start + 1;
            header("Content-Length: $length");

            $fp = fopen($file, 'rb');
            fseek($fp, $start);
            $remaining = $length;
            while ($remaining > 0 && !feof($fp)) {
                echo fread($fp, min(524288, $remaining));
                $remaining -= 524288;
                flush();
            }
            fclose($fp);
        } else {
            header("Content-Length: $size");
            readfile($file);
        }
        return true;
    }

    // Everything else: let PHP built-in server handle
    return false;
}

// Route everything else through Kirby
require __DIR__ . '/index.php';
