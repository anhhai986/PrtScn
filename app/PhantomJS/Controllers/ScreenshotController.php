<?php
namespace PhantomJS\Controllers;

use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| PhantomJS Screenshot Controller
|--------------------------------------------------------------------------
|
| This controller tries to extract all editable content from a template
|
*/

class ScreenshotController extends \App\Http\Controllers\Controller {

  /**
   * Instantiate a new instance.
   */
  public function __construct() {
    /**
     * Path where screenshots are stored relative from /public (public_path())
     */

    $this->storage_path = '/i/';

    /**
     * Path to PhantomJS build, relative from /app (app_path())
     */

    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
      $this->phantomjs_path = app_path() . '\\' . config('phantomjs.windows_path');
    } else {
      $this->phantomjs_path = app_path() . '/' . config('phantomjs.linux_path');
    }
  }

  /**
   * Create a screenshot
   *
   */
  public function grab() {
    $url = rawurldecode(request()->input('url', ''));
    $browser_width = request()->input('browser_width', 1768);
    $browser_height = request()->input('browser_height', 1098);
    $thumb_width = request()->input('thumb_width', 300);
    $thumb_height = request()->input('thumb_height', 'null');
    $empty_cache = (boolean) request()->input('empty_cache', false);
    $timeout = request()->input('timeout', 800);
    $trim = request()->input('trim', '');

    $opts = array();
    $opts[] = 'resize';
    if($trim != '') $opts['trim'] = $trim;

    $image_type = 'png';

    if($url == '') {
      die('No url');
    }

    $filename_screenshot = $url . '-' . $browser_width . '-' . $browser_height;
    $filename_thumb = $url . '-' . $browser_width . '-' . $browser_height . '-' . $thumb_width . '-' . $thumb_height;

    $file_screenshot = public_path() . $this->storage_path . md5($filename_screenshot) . '.png';
    $file_thumb = $this->storage_path . md5($filename_screenshot) . '.png';

    if($empty_cache) {
      \Croppa::delete($file_thumb);
    }

    if(! Storage::exists($file_screenshot) || $empty_cache) {
      $phantomjs = new \HybridLogic\PhantomJS\Runner($this->phantomjs_path);
      $result = $phantomjs->execute(app_path() . '/PhantomJS/NodeJS/screenshot.js', $url, $file_screenshot, $browser_width . '*' . $browser_height, $timeout);
    }

    $thumb = \Croppa::url($file_thumb, $thumb_width, $thumb_height, $opts);

    return $thumb;
  }
}