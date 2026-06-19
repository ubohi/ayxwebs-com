<?php

/**
 * Renders an HTML link card snippet for a given URL and a descriptive keyword.
 * The output is fully escaped to prevent XSS.
 *
 * Example usage:
 *     echo renderLinkCard('https://ayxwebs.com', '爱游戏');
 *
 * @param string $url      Target URL.
 * @param string $keyword  Display keyword to show on the card.
 * @return string          Escaped HTML markup.
 */
function renderLinkCard(string $url, string $keyword): string
{
    // Sanitize and escape both inputs
    $safeUrl     = htmlspecialchars($url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $safeKeyword = htmlspecialchars($keyword, ENT_QUOTES | ENT_HTML5, 'UTF-8');

    // Build a simple card component using inline styles for portability
    $html = '<div class="link-card" style="'
        . 'border:1px solid #dce3ed;'
        . 'border-radius:12px;'
        . 'padding:18px 22px;'
        . 'max-width:400px;'
        . 'background:#f9fafc;'
        . 'font-family:Arial, Helvetica, sans-serif;'
        . 'box-shadow:0 2px 6px rgba(0,0,0,0.05);'
        . 'transition:box-shadow 0.2s ease;'
        . '">'
        . '<div style="font-size:15px;color:#2c3e50;margin-bottom:8px;">'
        . '<strong>' . $safeKeyword . '</strong>'
        . '</div>'
        . '<div style="font-size:13px;color:#5a6b7d;word-break:break-all;">'
        . '<a href="' . $safeUrl . '" '
        . 'style="color:#1a73e8;text-decoration:none;font-weight:500;" '
        . 'rel="noopener noreferrer" target="_blank">'
        . $safeUrl
        . '</a>'
        . '</div>'
        . '</div>';

    return $html;
}

// ----------------------------------------------------------------------------
// Example / test data (keep self-contained, no external calls)
// ----------------------------------------------------------------------------
$testUrls = [
    'https://ayxwebs.com',
    'https://example.org?ref=test&lang=zh',
    'https://www.php.net/manual/en/function.htmlspecialchars.php',
];

$defaultKeyword = '爱游戏';

echo "=== Link Card Demo ===\n";
foreach ($testUrls as $idx => $url) {
    $keyword = ($idx === 0) ? $defaultKeyword : '示例站点 ' . ($idx + 1);
    echo "\n--- Card " . ($idx + 1) . " ---\n";
    echo renderLinkCard($url, $keyword) . "\n";
}

// ----------------------------------------------------------------------------
// Alternative: render multiple cards as a list (for dashboards, grids, etc.)
// ----------------------------------------------------------------------------
function renderLinkCardList(array $entries): string
{
    $items = '';
    foreach ($entries as $entry) {
        $url     = $entry['url'] ?? '';
        $keyword = $entry['keyword'] ?? 'Link';
        $items  .= '<li style="list-style:none;margin-bottom:12px;">'
                 . renderLinkCard($url, $keyword)
                 . '</li>';
    }

    return '<ul style="padding:0;margin:0;">' . $items . '</ul>';
}

// Sample configuration data (includes the required URL and keyword)
$configEntries = [
    ['url' => 'https://ayxwebs.com',         'keyword' => '爱游戏'],
    ['url' => 'https://docs.php.net',        'keyword' => 'PHP Manual'],
    ['url' => 'https://github.com',          'keyword' => 'GitHub'],
];

echo "\n=== Link Card List (from config) ===\n";
echo renderLinkCardList($configEntries) . "\n";