# Ensoar Pvt. Ltd. – Website

Auto finance DSA website (8 pages, PHP).

- **Live preview (GitHub Pages):** static copy in `docs/` — the form opens WhatsApp directly.
- **Real hosting (InfinityFree / any PHP host):** upload everything (except `docs/`) into `htdocs/`. Enquiries are saved to `data/leads.csv` and sent on WhatsApp.

Edit phone, email, addresses and hours in `includes/config.php`.
After editing, rebuild the preview: `python build-static.py path\to\php.exe`
