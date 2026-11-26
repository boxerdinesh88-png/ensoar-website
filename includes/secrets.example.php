<?php
// Copy this file to includes/secrets.php ON THE SERVER and fill it in. Never upload secrets.php to GitHub.

// MySQL: InfinityFree dashboard -> your account -> MySQL Databases (create one, then copy the details).
// Leave DB_HOST empty to save form entries to data/enquiries.csv instead.
const DB_HOST = '';            // e.g. sql123.infinityfree.com
const DB_NAME = '';            // e.g. if0_43540037_ensoar
const DB_USER = '';            // e.g. if0_43540037
const DB_PASS = '';            // your hosting account password (InfinityFree -> Account Details)

// Confirmation + office emails, sent from the info@ensoar.in mailbox (Hostinger email).
const SMTP_HOST = 'smtp.hostinger.com';
const SMTP_PORT = 465;
const SMTP_USER = 'info@ensoar.in';
const SMTP_PASS = '';          // the info@ensoar.in mailbox password (leave empty to turn emails off)

// Admin page login (admin.php). Use a strong password of at least 10 characters.
const ADMIN_USER = 'admin';
const ADMIN_PASS = '';
