# Sarla — Indian Kitchen & Bar

Restaurant website for Sarla (Hotel Sarla Inn, Sector 62 Noida). PHP 8 + Tailwind CSS v4.

## Run locally

```bash
npm install          # first time only
npm run build        # compile assets/css/app.css -> assets/css/style.css
php -S localhost:8000
```

Open http://localhost:8000. While editing styles, run `npm run dev` to rebuild CSS on save.

## Pages

| Page | File |
| --- | --- |
| Home | `index.php` |
| Menu (category tabs, veg-only filter) | `menu.php` |
| Our Story | `our-story.php` |
| Contact (form → `storage/messages.csv`) | `contact.php` |
| Book a Table (form → `storage/bookings.csv`) | `book.php` |

## Where to change things

- **Phone, email, address, hours, Zomato/Swiggy links, social links:** `includes/config.php`
- **Menu items and prices:** `includes/menu-data.php`
- **Colours and fonts:** the `@theme` block in `assets/css/app.css` (rebuild CSS after changes)
- **Photos:** `assets/img/` (current photos are Unsplash placeholders; swap them for the restaurant's own)
- **Logo:** `logo()` in `includes/functions.php` (inline SVG). Replace it with the client's logo file when available.

## Deploying

Upload everything except `node_modules/` to any PHP 8.1+ host. `storage/` must be writable by PHP. The `.htaccess` files block direct access to `storage/` and `includes/` on Apache.
