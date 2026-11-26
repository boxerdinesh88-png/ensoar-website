<?php
// Lead storage: MySQL when includes/secrets.php has DB details, otherwise data/leads.csv.
require_once __DIR__ . '/config.php';

const LEAD_COLS = ['kind', 'name', 'email', 'phone', 'loan', 'city', 'amount', 'income', 'message', 'ip'];
const LEAD_CSV  = __DIR__ . '/../data/enquiries.csv'; // (old leads.csv from the first version is not read)

function db(): ?PDO {
    static $pdo = false;
    if ($pdo !== false) return $pdo;
    $pdo = null;
    if (!defined('DB_HOST') || DB_HOST === '' || DB_PASS === '') return null; // not filled in yet = use CSV
    try {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_TIMEOUT => 5,
        ]);
        // The table creates itself on first use, so nothing has to be run in phpMyAdmin.
        $defs = array_map(fn($c) => $c === 'message' ? "`$c` TEXT" : "`$c` VARCHAR(255) NOT NULL DEFAULT ''", LEAD_COLS);
        $pdo->exec('CREATE TABLE IF NOT EXISTS `leads` (id INT AUTO_INCREMENT PRIMARY KEY, created_at DATETIME NOT NULL, ' . implode(', ', $defs) . ') CHARACTER SET utf8mb4');
    } catch (PDOException $e) {
        error_log('Ensoar DB: ' . $e->getMessage());
        $pdo = null;
    }
    return $pdo;
}

// Save one lead. Falls back to CSV if the database is down, so no enquiry is lost.
function save_lead(array $row): bool {
    $row = ['created_at' => date('Y-m-d H:i:s')] + array_intersect_key($row, array_flip(LEAD_COLS));
    if ($pdo = db()) {
        try {
            $cols = array_keys($row);
            $pdo->prepare('INSERT INTO `leads` (`' . implode('`,`', $cols) . '`) VALUES (' . rtrim(str_repeat('?,', count($cols)), ',') . ')')
                ->execute(array_values($row));
            return true;
        } catch (PDOException $e) {
            error_log('Ensoar DB insert: ' . $e->getMessage());
        }
    }
    $new = !is_file(LEAD_CSV);
    if (!$fh = @fopen(LEAD_CSV, 'a')) return false;
    flock($fh, LOCK_EX);
    if ($new) fputcsv($fh, array_keys($row));
    // prefix formula characters so the CSV is safe to open in Excel
    fputcsv($fh, array_map(fn($v) => preg_match('/^[=+\-@]/', (string)$v) ? "'$v" : $v, array_values($row)));
    flock($fh, LOCK_UN);
    fclose($fh);
    return true;
}

// Newest first: database rows plus any CSV fallback rows.
function load_leads(int $limit = 1000): array {
    $rows = [];
    if ($pdo = db()) $rows = $pdo->query('SELECT * FROM `leads` ORDER BY id DESC LIMIT ' . (int)$limit)->fetchAll();
    if (is_file(LEAD_CSV) && ($fh = fopen(LEAD_CSV, 'r'))) {
        $head = fgetcsv($fh);
        while ($head && ($r = fgetcsv($fh)) !== false) {
            if (count($r) === count($head)) $rows[] = array_combine($head, $r) + ['id' => 'file'];
        }
        fclose($fh);
    }
    usort($rows, fn($a, $b) => strcmp($b['created_at'] ?? '', $a['created_at'] ?? ''));
    return array_slice($rows, 0, $limit);
}
