<?php
require_once __DIR__ . '/includes/functions.php';

$rawPath = $_GET['path'] ?? '';

$path = sanitizeArticlePath($rawPath);
if ($path === null) {
    http_response_code(400);
    $pageTitle = 'Invalid Path';
    require_once __DIR__ . '/templates/head.php';
    require_once __DIR__ . '/templates/header.php';
    echo '<h1>Invalid Path</h1>';
    echo '<p>The requested article path contains invalid characters.</p>';
    echo '<p><a href="index.php">Return to Main Page</a></p>';
    require_once __DIR__ . '/templates/footer.php';
    exit;
}

$mdFile = resolveArticlePath($path);
if ($mdFile === null || !file_exists($mdFile)) {
    http_response_code(404);
    $pageTitle = 'Article Not Found';
    require_once __DIR__ . '/templates/head.php';
    require_once __DIR__ . '/templates/header.php';
    echo '<h1>Article Not Found</h1>';
    echo '<p>The requested article could not be found.</p>';
    echo '<p><a href="index.php">Return to Main Page</a></p>';
    require_once __DIR__ . '/templates/footer.php';
    exit;
}

$raw = file_get_contents($mdFile);

preg_match('/^# (.+)$/m', $raw, $titleMatch);
$pageTitle = $titleMatch[1] ?? ucwords(str_replace(['-', '_'], ' ', basename($path)));

require_once __DIR__ . '/templates/head.php';
require_once __DIR__ . '/templates/header.php';

$html = renderMarkdown($raw);
echo '<div class="article-content">';
echo $html;
echo '</div>';

echo '<hr><p><a href="index.php">&larr; Back to Main Page</a></p>';

function sanitizeArticlePath(string $input): ?string {
    if ($input === '') return null;
    $input = str_replace('\\', '/', $input);
    $parts = explode('/', $input);
    foreach ($parts as $part) {
        if ($part === '..' || $part === '.' || $part === '') return null;
    }
    if (preg_match('/[^\w\-\/]/', $input)) return null;
    return $input;
}

function resolveArticlePath(string $path): ?string {
    $base = realpath(__DIR__ . '/articles');
    if ($base === false) return null;
    $resolved = realpath($base . '/' . $path . '.md');
    if ($resolved === false) return null;
    if (!str_starts_with($resolved, $base)) return null;
    if (!str_ends_with($resolved, '.md')) return null;
    return $resolved;
}

function renderMarkdown(string $raw): string {
    $lines = explode("\n", $raw);
    $html = '';
    $inCodeBlock = false;
    $codeContent = '';
    $codeLang = '';
    $inList = false;
    $listType = '';
    $inBlockquote = false;
    $inTable = false;
    $pendingHeader = null;

    $closeTable = function() use (&$html, &$inTable, &$pendingHeader) {
        if ($inTable) { $html .= "</table></div>\n"; $inTable = false; $pendingHeader = null; }
        $pendingHeader = null;
    };

    foreach ($lines as $line) {
        $trimmed = trim($line);

        if (preg_match('/^```(\w*)/', $line, $m)) {
            if ($inCodeBlock) {
                $code = htmlspecialchars($codeContent);
                $html .= "<pre><code" . ($codeLang ? " class=\"language-" . htmlspecialchars($codeLang) . "\"" : '') . ">$code</code></pre>\n";
                $codeContent = '';
                $codeLang = '';
                $inCodeBlock = false;
            } else {
                $inCodeBlock = true;
                $codeLang = $m[1];
            }
            continue;
        }
        if ($inCodeBlock) {
            $codeContent .= $line . "\n";
            continue;
        }

        if ($trimmed === '') {
            $closeTable();
            if ($inBlockquote) { $html .= "</blockquote>\n"; $inBlockquote = false; }
            if ($inList) { $html .= ($listType === 'ul') ? "</ul>\n" : "</ol>\n"; $inList = false; }
            $html .= "<br>\n";
            continue;
        }

        if (str_starts_with($trimmed, '> ')) {
            $closeTable();
            if ($inList) { $html .= ($listType === 'ul') ? "</ul>\n" : "</ol>\n"; $inList = false; }
            if (!$inBlockquote) { $html .= "<blockquote>\n"; $inBlockquote = true; }
            $html .= "<p>" . htmlspecialchars(substr($trimmed, 2)) . "</p>\n";
            continue;
        }
        if ($inBlockquote) { $html .= "</blockquote>\n"; $inBlockquote = false; }

        if (preg_match('/^(#{1,6})\s(.+)/', $line, $m)) {
            $closeTable();
            if ($inList) { $html .= ($listType === 'ul') ? "</ul>\n" : "</ol>\n"; $inList = false; }
            $level = strlen($m[1]);
            $text = htmlspecialchars(trim($m[2]));
            $id = preg_replace('/[^a-z0-9]+/', '-', strtolower($text));
            $html .= "<h$level id=\"$id\">$text<a class=\"anchor\" href=\"#$id\" title=\"Permalink\">#</a></h$level>\n";
            continue;
        }

        if (preg_match('/^[-*]\s(.+)/', $line, $m) && !preg_match('/^\*.*\*$/', $line)) {
            $closeTable();
            if ($inList && $listType !== 'ul') { $html .= "</ol>\n<ul>\n"; $listType = 'ul'; }
            if (!$inList) { $html .= "<ul>\n"; $inList = true; $listType = 'ul'; }
            $html .= "<li>" . inlineMarkdown(htmlspecialchars(trim($m[1]))) . "</li>\n";
            continue;
        }

        if (preg_match('/^\d+[.)]\s(.+)/', $line, $m)) {
            $closeTable();
            if ($inList && $listType !== 'ol') { $html .= "</ul>\n<ol>\n"; $listType = 'ol'; }
            if (!$inList) { $html .= "<ol>\n"; $inList = true; $listType = 'ol'; }
            $html .= "<li>" . inlineMarkdown(htmlspecialchars(trim($m[1]))) . "</li>\n";
            continue;
        }

        if (preg_match('/^---+$/', $trimmed) || preg_match('/^\*\*\*+$/', $trimmed)) {
            $closeTable();
            if ($inList) { $html .= ($listType === 'ul') ? "</ul>\n" : "</ol>\n"; $inList = false; }
            $html .= "<hr>\n";
            continue;
        }

        if (preg_match('/^\|(.+)\|$/', $line, $m)) {
            if ($inList) { $html .= ($listType === 'ul') ? "</ul>\n" : "</ol>\n"; $inList = false; }
            $cells = array_map('trim', explode('|', $m[1]));
            if (preg_match('/^[-| :]+$/', $cells[0] ?? '')) {
                if ($pendingHeader !== null) {
                    $html .= "<div class=\"table-wrapper\"><table class=\"wikitable\">\n";
                    $html .= "<tr><th>" . implode('</th><th>', $pendingHeader) . "</th></tr>\n";
                    $inTable = true;
                    $pendingHeader = null;
                }
                continue;
            }
            $cellContent = array_map(fn($c) => inlineMarkdown(htmlspecialchars(trim($c))), $cells);
            if (!$inTable) {
                if ($pendingHeader === null) {
                    $pendingHeader = $cellContent;
                    continue;
                } else {
                    $html .= "<div class=\"table-wrapper\"><table class=\"wikitable\">\n";
                    $html .= "<tr><td>" . implode('</td><td>', $pendingHeader) . "</td></tr>\n";
                    $html .= "<tr><td>" . implode('</td><td>', $cellContent) . "</td></tr>\n";
                    $inTable = true;
                    $pendingHeader = null;
                }
            } else {
                $html .= "<tr><td>" . implode('</td><td>', $cellContent) . "</td></tr>\n";
            }
            continue;
        }

        if ($inList) { $html .= ($listType === 'ul') ? "</ul>\n" : "</ol>\n"; $inList = false; }
        $closeTable();

        $html .= "<p>" . inlineMarkdown(htmlspecialchars($line)) . "</p>\n";
    }

    if ($inCodeBlock) {
        $code = htmlspecialchars($codeContent);
        $html .= "<pre><code>$code</code></pre>\n";
    }
    $closeTable();
    if ($inList) $html .= ($listType === 'ul') ? "</ul>\n" : "</ol>\n";
    if ($inBlockquote) $html .= "</blockquote>\n";

    return $html;
}

function inlineMarkdown(string $text): string {
    $text = preg_replace('/\*\*(.+?)\*\*/', '<strong>$1</strong>', $text);
    $text = preg_replace('/\*(.+?)\*/', '<em>$1</em>', $text);
    $text = preg_replace('/`(.+?)`/', '<code>$1</code>', $text);
    return $text;
}

require_once __DIR__ . '/templates/footer.php';
