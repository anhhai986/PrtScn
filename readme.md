# PrtScn
**Create website screenshots with Laravel and PhantomJS.**

## Getting started
### Upload files
Upload the files and configure your web server's document / web root to be the `public` directory. 

### Config file
Rename the `.env.example` file in the root to `.env`. By default all configurations should be fine. There is no need for database, cache or mail configuration.

### Composer
SSH to the root of the installation, install Composer (https://getcomposer.org/download/) and run:

`$ composer install`

Then generate a Laravel key with:

`$ php artisan key:generate`

### Directory permissions
Make sure these directories are writable:

 - `/bootstrap/cache/`
 - `/public/i/`
 - `/storage/app/public/`
 - `/storage/framework/cache/`
 - `/storage/framework/sessions/`
 - `/storage/framework/views/`
 - `/storage/logs/`


## Usage
If the script is installed on `https://snap.example.com`, it can be called like `https://snap.example.com/grab?url=<webpage url>&browser_width=1768&browser_width=1098&thumb_width=300`.

The script will return an image path like `/i/c477bb2c52219e9bc00ffd4e6e18c658-300x0-resize.png?token=6c15aeaf2b692deaa4f82cfb5a5e687f`. Which means the image is accessible at `https://snap.example.com/i/c477bb2c52219e9bc00ffd4e6e18c658-300x0-resize.png?token=6c15aeaf2b692deaa4f82cfb5a5e687f`.

### Querystring parameters

 - `url`: required, url of web page to make a screenshot of.
 - `browser_width`: optional, default 1768. Width of browser view.
 - `browser_height`: optional, default 1098. Height of browser view. If 'null', full height of web page is used.
 - `thumb_width`: optional, default 300. Width of screenshot. If 'null', the width depends on the height.
 - `thumb_height`: optional, default null. Height of screenshot. If 'null', the height depends on the width.
 - `empty_cache`: optional, default 0. If true (1) the screenshot will be recreated.
 - `timeout`: optional, default 800. Milliseconds to wait after loading the page before creating screenshot.
