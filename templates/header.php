<div id="content" class="mw-body">
    <div id="sidebar">
        <div id="logo">
            <a href="index.php">
                <img src="css/favicon.ico" alt="W" style="width:32px;height:32px;border:none;">
            </a>
        </div>
        <div class="sidebar-title">Roblox Reverse Engineering Wiki</div>
        <div class="sidebar-tagline">Roblox Patching Knowledge Base</div>
        <hr>
        <ul class="sidebar-nav">
            <li><a href="index.php">Main Page</a></li>
            <li><a href="index.php">Categories</a></li>
            <li><a href="search.php">Search</a></li>
            <li><a href="guides.zip">Download All Guides</a></li>
        </ul>
        <hr>
        <div class="sidebar-cat-title">Categories</div>
        <ul class="sidebar-nav sidebar-cats">
            <?php
            $tree = getArticleTree();
            foreach ($tree as $cat => $info):
            ?>
            <li><a href="index.php#<?= htmlspecialchars($cat) ?>"><?= htmlspecialchars($info['label']) ?></a></li>
            <?php endforeach; ?>
        </ul>
        <hr>
        <div class="sidebar-stats">
            <strong><?= count(getAllArticles()) ?></strong> articles
        </div>
    </div>
    <div id="main-content">
        <div id="topbar">
            <form action="search.php" method="get" class="search-form">
                <input type="text" name="q" placeholder="Search wiki..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
                <button type="submit">Search</button>
            </form>
            <div class="topbar-links">
                <a href="index.php">Home</a>
                <a href="search.php">Search</a>
            </div>
        </div>
        <div id="bodyContent">