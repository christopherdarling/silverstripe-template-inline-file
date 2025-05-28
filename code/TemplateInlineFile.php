<?php

namespace ChristopherDarling\TemplateInlineFile;

use SilverStripe\Control\Director;
use SilverStripe\View\TemplateGlobalProvider;

class TemplateInlineFile implements TemplateGlobalProvider
{

    public static function get_template_global_variables()
    {
        return [
            'TemplateInlineFile' => [
                'method' => 'getPath',
                'casting' => 'HTMLFragment'
            ]
        ];
    }

	/**
	 * @param mixed ...$paths
	 * @return false|string|void
	 */
    public static function getPath(...$paths)
    {
        $path = implode('', $paths);

        $absPath = Director::getAbsFile($path);

        if (!file_exists($absPath)) {
            user_error('TemplateInlineFile $path (' . $absPath  .') does not exist');
            return;
        }

        return file_get_contents($absPath);
    }

}
