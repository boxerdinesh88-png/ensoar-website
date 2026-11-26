<?php
// Edit company details here — every page reads from this file.
date_default_timezone_set('Asia/Kolkata');
// Database, email (SMTP) and admin login live in secrets.php (server only, never in git). See secrets.example.php.
// A typo in secrets.php must never take the whole site down: the error is caught and only its line number is kept
// (the message itself could contain part of a password).
$SECRETS_ERROR = null;
if (is_file(__DIR__ . '/secrets.php')) {
    try { require_once __DIR__ . '/secrets.php'; }
    catch (Throwable $e) { $SECRETS_ERROR = 'line ' . $e->getLine(); error_log('Ensoar secrets.php error on ' . $SECRETS_ERROR); }
}
const SITE_URL    = 'https://ensoar.in'; // no trailing slash
const SITE_NAME   = 'Ensoar Pvt. Ltd.';
const SITE_SHORT  = 'Ensoar';
const PHONE       = '+91 96544 02358';
const PHONE_RAW   = '919654402358';
const EMAIL       = 'info@ensoar.in';
const OFFICE_ADDR = '2nd Floor, S-4, Aditya City Center, Vaibhav Khand, Indirapuram, Ghaziabad, Uttar Pradesh – 201014';
const REG_ADDR    = '39, Shivam Apartments, Rohini Sector-15, Delhi – 110089';
const HOURS       = 'Mon – Sat, 9:30 AM – 7:00 PM';

// Real photos from Unsplash (free licence), served full-quality from their CDN.
function img(string $id, int $w = 1600): string {
    return "https://images.unsplash.com/photo-$id?auto=format&fit=crop&w=$w&q=85";
}

function page_hero(string $h1, string $sub, string $photo, string $crumb): void {
    echo '<section class="page-hero"><div class="hero-bg" style="background-image:url(\'' . img($photo, 2000) . '\')"></div><div class="wrap">'
       . '<h1 class="reveal">' . $h1 . '</h1><p class="reveal">' . $sub . '</p>'
       . '<nav class="crumbs reveal" aria-label="Breadcrumb"><a href="index.php">Home</a> / <span>' . $crumb . '</span></nav></div></section>';
}

function e(string $s): string { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }

const LOANS = [
    'new-car'    => ['New Car Loan', 'car', '1494976388531-d1058494cdd8', 'Drive home your dream car with up to 100% on-road funding, quick approvals and tenures up to 7 years.'],
    'used-car'   => ['Used Car Loan', 'key', '1549317661-bd32c8ce0db2', 'Finance a pre-owned car from a dealer or individual seller with fair valuation and fast disbursal.'],
    'commercial' => ['Commercial Vehicle Loan', 'truck', '1519003722824-194d4455a60c', 'Trucks, pickups, buses and LCVs for fleet owners, first-time buyers and transporters.'],
    'two-wheeler'=> ['Two-Wheeler Loan', 'bike', '1558981806-ec527fa84c39', 'Bikes, scooters and EVs with low down payment and simple documentation.'],
    'loan-against-car' => ['Loan Against Car', 'cash', '1552519507-da3b142c6e3d', 'Unlock cash from the car you already own — keep driving it while you repay.'],
    'balance-transfer' => ['Balance Transfer & Top-up', 'swap', '1554224155-6726b3ff858f', 'Move your running car loan to a lower rate and get an extra top-up amount.'],
];

function icon(string $n): string {
    $p = [
        'car'   => '<path d="M5 17h14M6 17v2M18 17v2M3 13l2-6a2 2 0 0 1 2-1.4h10A2 2 0 0 1 19 7l2 6v4H3z"/><circle cx="7.5" cy="13.5" r="1"/><circle cx="16.5" cy="13.5" r="1"/>',
        'key'   => '<circle cx="8" cy="15" r="4"/><path d="M11 12l9-9M17 6l3 3M15 8l2 2"/>',
        'truck' => '<path d="M2 6h11v10H2zM13 10h4l4 4v2h-8z"/><circle cx="6" cy="18" r="2"/><circle cx="17" cy="18" r="2"/>',
        'bike'  => '<circle cx="5.5" cy="16.5" r="3.5"/><circle cx="18.5" cy="16.5" r="3.5"/><path d="M5.5 16.5L10 8h5l3.5 8.5M10 8l3 8.5h-7.5M14 5h3"/>',
        'cash'  => '<rect x="2" y="6" width="20" height="12" rx="2"/><circle cx="12" cy="12" r="3"/><path d="M6 12h.01M18 12h.01"/>',
        'swap'  => '<path d="M7 4L3 8l4 4M3 8h14M17 20l4-4-4-4M21 16H7"/>',
        'bolt'  => '<path d="M13 2L4 14h7l-1 8 9-12h-7z"/>',
        'shield'=> '<path d="M12 2l8 4v6c0 5-3.5 9-8 10-4.5-1-8-5-8-10V6z"/><path d="M9 12l2 2 4-4"/>',
        'bank'  => '<path d="M3 10h18L12 4zM5 10v8M9 10v8M15 10v8M19 10v8M3 20h18"/>',
        'home'  => '<path d="M3 11l9-7 9 7v9h-6v-6H9v6H3z"/>',
        'doc'   => '<path d="M14 2H6v20h12V6z"/><path d="M14 2v4h4M9 13h6M9 17h6"/>',
        'chat'  => '<path d="M21 12a8 8 0 0 1-11.8 7L3 21l2-6A8 8 0 1 1 21 12z"/>',
        'phone' => '<path d="M5 3h4l2 5-2.5 1.5a11 11 0 0 0 6 6L16 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 5a2 2 0 0 1 2-2z"/>',
        'pin'   => '<path d="M12 22s7-6.5 7-12a7 7 0 0 0-14 0c0 5.5 7 12 7 12z"/><circle cx="12" cy="10" r="2.5"/>',
        'mail'  => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/>',
        'clock' => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
        'users' => '<circle cx="9" cy="8" r="3.5"/><path d="M2 20a7 7 0 0 1 14 0M16 4a3.5 3.5 0 0 1 0 7M22 20a7 7 0 0 0-4-6.3"/>',
        'check' => '<path d="M5 12l5 5L20 7"/>',
        'arrow' => '<path d="M5 12h14M13 6l6 6-6 6"/>',
        'calc'  => '<rect x="5" y="2" width="14" height="20" rx="2"/><path d="M8 6h8v4H8zM8 14h.01M12 14h.01M16 14h.01M8 18h.01M12 18h.01M16 18h.01"/>',
    ];
    return '<svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . ($p[$n] ?? '') . '</svg>';
}
