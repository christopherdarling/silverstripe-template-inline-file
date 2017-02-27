<?php

namespace ChristopherDarling\TemplateInlineFile;

use \SSViewer;
use \Director;

class TemplateInlineFile implements \TemplateGlobalProvider
{

  public static function get_template_global_variables()
  {
      return array(
          'TemplateInlineFile' => array(
            'method' => 'getPath',
            'casting' => 'HTMLText'
          )
      );
  }

  public static function getPath($path, $pathB=null)
  {
    if (!is_null($pathB)) {
      $path = $path . $pathB;
    }

    $theme = SSViewer::get_theme_folder();
    $absPath = Director::getAbsFile($path);

    if (!file_exists($absPath)) {
      user_error('TemplateInlineFile $path (' . $absPath  .') does not exist');
      return;
    }

    return file_get_contents($absPath);
  }

}
