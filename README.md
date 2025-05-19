
# Wordpress Plugin: Forminator Timed File Download

Collect user email via Forminator and send a secure, time-limited download link for selected files.

## Features

- 📄 Integrates with [Forminator](https://wordpress.org/plugins/forminator/)
- 🔐 Token-based secure file download
- ⏱ Time-limited links (customizable via constants)
- ✉️ Sends HTML email with file details and a download button
- 🧾 Includes file metadata such as checksum, version, and size

## Installation

1. Upload the plugin folder `forminator-timed-download` to `/wp-content/plugins/`.
2. Activate the plugin via WordPress admin.
3. Ensure the Forminator plugin is installed and active.
4. Create a form with the following fields:
   - Name: `name-1`
   - Email: `email-1`
   - File select dropdown: `select-2` (or `select-3`, `select-4`)
5. Modify `includes/constants.php` to set:
   - `TFD_FORM_ID` (your Forminator form ID)
   - `TFD_TOKEN_TTL` (token expiration in seconds)
6. Ensure your DB table `{prefix}_tfd_files` contains:
   - `file_name`, `product`, `version`, `file_size`, `checksum`, `download_url`
7. Customize the email layout in `includes/shortcode.php`.

## How It Works

- When a user submits the form, a token is generated.
- A transient is created for this token, storing the download URL.
- The user receives a styled HTML email with a download button.
- The button links to a secure endpoint with the token.
- The file download only works if the token is still valid.

## Security

- No direct file links exposed
- Token is unique, random, and time-limited
- Transient stored on the server, ensuring one-time access

## Customization

- Email layout: `includes/shortcode.php`
- Token TTL and Form ID: `includes/constants.php`
- Add fields or log access by editing `submission-handler.php`
