# Ensoar Pvt. Ltd. – Website

Auto finance DSA website (8 pages, PHP).

- **Live preview (GitHub Pages):** static copy in `docs/` — the form opens WhatsApp directly.
- **Real hosting (InfinityFree / any PHP host):** upload everything (except `docs/`) into `htdocs/`. Enquiries are saved to `data/leads.csv` and sent on WhatsApp.

Edit phone, email, addresses and hours in `includes/config.php`.

**Admin, database & emails:** copy `includes/secrets.example.php` to `includes/secrets.php` on the server and fill in MySQL, the info@ensoar.in mailbox password and an admin password. Then open `/admin.php` to see every form entry and download them as Excel (CSV). Each form sends a confirmation email to the customer and a copy to info@ensoar.in.
After editing, rebuild the preview: `python build-static.py path\to\php.exe`
