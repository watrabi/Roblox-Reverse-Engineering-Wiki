<?php
error_reporting(0);
@ini_set('display_errors', '0');
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/templates/credits.php';
$pageTitle = 'Main Page';
require_once __DIR__ . '/templates/head.php';
require_once __DIR__ . '/templates/header.php';

$articles = getAllArticles();
$tree = getArticleTree();
$allCredits = array_merge($creditsPrimarySources, $creditsGuideAuthors, $creditsResourceContributors);
shuffle($allCredits);
?>

<div class="welcome-box">
    <h1>Welcome to the Roblox Reverse Engineering Wiki</h1>
    <marquee behavior="scroll" direction="left" scrollamount="2"><?= htmlspecialchars(implode(' | ', array_slice($allCredits, 0, 15))) ?></marquee>
    <marquee behavior="scroll" direction="left" scrollamount="2"><?= htmlspecialchars(implode(' | ', array_slice($allCredits, 15, 15))) ?></marquee>
    <marquee behavior="scroll" direction="left" scrollamount="2"><?= htmlspecialchars(implode(' | ', array_slice($allCredits, 30))) ?> | and many more anonymous contributors</marquee>
    <p>Community-sourced Roblox patching and reverse engineering guides.</p>
    <p>This wiki contains <strong><?= count($articles) ?></strong> articles covering client patching, RCC service, mobile, network, bytecode, and more.</p>

    <p><a href="guides.zip" class="download-link">Download All Guides (ZIP)</a></p>

    <div class="stat-box">
        <div class="stat-item">
            <div class="stat-number"><?= count($articles) ?></div>
            <div class="stat-label">Articles</div>
        </div>
        <div class="stat-item">
            <div class="stat-number"><?= count($tree) ?></div>
            <div class="stat-label">Categories</div>
        </div>
    </div>
</div>

<h2>Categories</h2>

<div class="category-grid">
    <?php foreach ($tree as $cat => $info): ?>
    <div class="category-card">
        <h3><a href="category.php?cat=<?= htmlspecialchars($cat) ?>"><?= htmlspecialchars($info['label']) ?></a></h3>
        <?php foreach ($info['subs'] as $sub => $sinfo): ?>
        <h4><?= htmlspecialchars($sinfo['label']) ?></h4>
        <ul>
            <?php foreach ($sinfo['articles'] as $a): ?>
            <li><a href="<?= htmlspecialchars($a['url']) ?>"<?= !empty($a['outlink']) ? ' class="outlink"' : '' ?>><?= htmlspecialchars($a['title']) ?></a></li>
            <?php endforeach; ?>
        </ul>
        <?php endforeach; ?>
        <div class="article-count">
            <?php
            $count = 0;
            foreach ($info['subs'] as $sinfo) $count += count($sinfo['articles']);
            echo "$count article(s)";
            ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php require_once __DIR__ . '/templates/footer.php'; ?>
