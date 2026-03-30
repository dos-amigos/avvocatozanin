<?php
// Only render on non-home pages
if ($page->isHomePage()) return;

// Build breadcrumb items: [Home] + ancestors + [current page]
$items = [];
$position = 1;

// Home
$items[] = [
  'name'     => 'Home',
  'url'      => $site->url(),
  'position' => $position++,
  'current'  => false,
];

// Ancestors (e.g., "Servizi" when on a service sub-page)
foreach ($page->parents()->flip() as $ancestor) {
  $items[] = [
    'name'     => $ancestor->title()->html(),
    'url'      => $ancestor->url(),
    'position' => $position++,
    'current'  => false,
  ];
}

// Current page
$items[] = [
  'name'     => $page->title()->html(),
  'url'      => $page->url(),
  'position' => $position,
  'current'  => true,
];
?>

<nav aria-label="Breadcrumb" class="breadcrumb-nav">
  <ol class="breadcrumb">
    <?php foreach ($items as $i => $item): ?>
      <li class="breadcrumb__item<?= $item['current'] ? ' breadcrumb__item--active' : '' ?>"<?= $item['current'] ? ' aria-current="page"' : '' ?>>
        <?php if (!$item['current']): ?>
          <a href="<?= $item['url'] ?>" class="breadcrumb__link"><?= $item['name'] ?></a>
          <span class="breadcrumb__separator" aria-hidden="true">/</span>
        <?php else: ?>
          <?= $item['name'] ?>
        <?php endif ?>
      </li>
    <?php endforeach ?>
  </ol>
</nav>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    <?php foreach ($items as $i => $item): ?>
    {
      "@type": "ListItem",
      "position": <?= $item['position'] ?>,
      "name": "<?= $item['name'] ?>"
      <?= !$item['current'] ? ', "item": "' . $item['url'] . '"' : '' ?>
    }<?= $i < count($items) - 1 ? ',' : '' ?>
    <?php endforeach ?>
  ]
}
</script>
