<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php
  $metaTitle = $page->meta_title()->isNotEmpty() ? $page->meta_title()->value() : $page->title()->value();
  $siteTitle = $site->title()->value();
  $fullTitle = ($page->isHomePage()) ? $siteTitle : $metaTitle . ' | ' . $siteTitle;
  $metaDesc  = $page->meta_description()->isNotEmpty() ? $page->meta_description()->value() : ($site->meta_description()->isNotEmpty() ? $site->meta_description()->value() : '');
  $ogImage   = $page->og_image()->toFile() ?? $site->og_image()->toFile();
  ?>
  <title><?= esc($fullTitle) ?></title>
  <?php if ($metaDesc): ?><meta name="description" content="<?= esc($metaDesc) ?>"><?php endif ?>
  <meta property="og:title" content="<?= esc($fullTitle) ?>">
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?= $page->url() ?>">
  <meta property="og:site_name" content="<?= esc($siteTitle) ?>">
  <?php if ($metaDesc): ?><meta property="og:description" content="<?= esc($metaDesc) ?>"><?php endif ?>
  <?php if ($ogImage): ?><meta property="og:image" content="<?= $ogImage->url() ?>"><?php endif ?>

  <link rel="icon" type="image/png" href="<?= url('assets/img/favicon.png') ?>">

  <!-- Fonts: Instrument Serif (headings) + Manrope (body) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Manrope:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Lenis CSS -->
  <link rel="stylesheet" href="https://unpkg.com/lenis@1.3.17/dist/lenis.css">

  <!-- Main stylesheet -->
  <?= css('assets/css/main.css') ?>

  <!-- Page-specific CSS -->
  <?php
  $pageCss = [
    'home'        => 'assets/css/pages/homepage.css',
    'servizi'     => 'assets/css/pages/servizi.css',
    'servizio'    => 'assets/css/pages/servizio.css',
    'contatti'    => 'assets/css/pages/contatti.css',
    'chi-sono'    => 'assets/css/pages/chi-sono.css',
    'come-lavoro' => 'assets/css/pages/come-lavoro.css',
  ];
  $template = $page->intendedTemplate()->name();
  if (isset($pageCss[$template])):
  ?>
  <?= css($pageCss[$template]) ?>
  <?php endif ?>
</head>
<body>
