<?php
require_once __DIR__ . '/includes/functions.php';

$cat = $_GET['cat'] ?? '';
$tree = getArticleTree();

if (!isset($tree[$cat])) {
    http_response_code(404);
    $pageTitle = 'Category Not Found';
    require_once __DIR__ . '/templates/head.php';
    require_once __DIR__ . '/templates/header.php';
    echo '<h1>Category Not Found</h1>';
    echo '<p><a href="index.php">Return to Main Page</a></p>';
    require_once __DIR__ . '/templates/footer.php';
    exit;
}

$info = $tree[$cat];
$pageTitle = $info['label'];
require_once __DIR__ . '/templates/head.php';
require_once __DIR__ . '/templates/header.php';
?>

<h1><?= htmlspecialchars($info['label']) ?></h1>

<?php foreach ($info['subs'] as $sub => $sinfo): ?>
<h2><?= htmlspecialchars($sinfo['label']) ?></h2>
<ul class="article-list">
    <?php foreach ($sinfo['articles'] as $a): ?>
    <li>
        <div class="article-title"><a href="<?= htmlspecialchars($a['url']) ?>"<?= !empty($a['outlink']) ? ' class="outlink"' : '' ?>><?= htmlspecialchars($a['title']) ?></a></div>
        <?php if (!empty($a['description'])): ?>
        <div class="article-meta-sm"><?= htmlspecialchars($a['description']) ?></div>
        <?php endif; ?>
    </li>
    <?php endforeach; ?>
</ul>
<?php endforeach; ?>

<?php require_once __DIR__ . '/templates/footer.php'; ?>
