<?php

namespace AssetThumbnailLink;

use Pimcore\API\Plugin as PluginLib;

class Plugin extends PluginLib\AbstractPlugin implements PluginLib\PluginInterface
{

    public function init()
    {
        parent::init();
    }

    public static function install()
    {
        $config = new \Zend_Config(array(), true);
        $config->thumbnails = [
            'thumbnail' => [
                "__CONFIGURE_PLUGIN_THUMBNAIL_1__",
                "__CONFIGURE_PLUGIN_THUMBNAIL_2__"
            ]
        ];

        $configWriter = new \Zend_Config_Writer_Xml();
        $configWriter->setConfig($config);
        $configWriter->write(self::getConfigName());
        return 'Plugin successfully installed';
    }
    
    public static function needsReloadAfterInstall() {
        return true; 
    }
    
    public static function uninstall()
    {
        if (file_exists(self::getConfigName())) {
            unlink(self::getConfigName());
        }

        return 'Plugin successfully un-installed';
    }

    public static function isInstalled()
    {
        if (file_exists(self::getConfigName())) {
            return true;
        }

        return false;
    }

    public static function getConfigName()
    {
        return PIMCORE_WEBSITE_PATH
        . '/var/config/'
        . 'extension-'
        . str_replace('\plugin', '', strtolower(__CLASS__))
        . '.xml';
    }
}
