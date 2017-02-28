<?php

namespace Termite;

/**
 * Class Autoloader
 * @package Termite
 */
class Autoloader
{
    /**
     * @var string
     */
    public static $ENVIRONMENT = 'production';
    /**
     * @var string
     */
    public static $DEV_VENDOR_PATH = '/dev_vendor';

    public function __construct($ENVIRONMENT = 'production', $DEV_VENDOR_PATH = '/dev_vendor')
    {
        static::setENVIRONMENT($ENVIRONMENT);
        static::setDEVVENDORPATH($DEV_VENDOR_PATH);
        $this->registerAutoloader();
    }

    public function termiteComposer($class)
    {
        $devVendorDir = static::getDEVVENDORPATH();
        if (file_exists($devVendorDir) && static::getENVIRONMENT() == 'development') {
            $parts = explode('\\', $class);
            if (!isset($parts[0])) {
                return;
            }
            $namespace = $parts[0];
            unset($parts[0]);
            $jsonFile = $devVendorDir . '/' . $namespace . '/composer.json';

            if (!file_exists($jsonFile)) {
                return;
            }
            $jsonData = file_get_contents($jsonFile);
            $data = json_decode($jsonData);
            $psr4 = 'psr-4';
            $psr0 = 'psr-0';
            $routes = array();
            if (isset($data->autoload->{$psr4})) {
                foreach ($data->autoload->{$psr4} as $autoload) {
                    $route = $devVendorDir . '/' . $namespace . '/' . $autoload;
                    $routes[] = $route;
                    $fullPath = $route . implode("/", $parts) . '.php';
                    if (is_readable($fullPath)) {
                        @include_once($fullPath);
                        break;
                    }
                }
            }
            if (isset($data->autoload->{$psr0})) {
                foreach ($data->autoload->{$psr0} as $autoload) {
                    $route = $devVendorDir . '/' . $namespace . '/' . $autoload;
                    $routes[] = $route;
                    $fullPath = $route . implode("/", $parts) . '.php';
                    if (is_readable($fullPath)) {
                        @include_once($fullPath);
                        break;
                    }
                }
            }

            return true;

        }
    }

    public function registerAutoloader()
    {
        spl_autoload_register(array($this, 'termiteComposer'), true, true);
    }

    /**
     * @return string
     */
    public static function getENVIRONMENT()
    {
        return self::$ENVIRONMENT;
    }

    /**
     * @param string $ENVIRONMENT
     */
    public static function setENVIRONMENT($ENVIRONMENT)
    {
        self::$ENVIRONMENT = $ENVIRONMENT;
    }

    /**
     * @return string
     */
    public static function getDEVVENDORPATH()
    {
        return self::$DEV_VENDOR_PATH;
    }

    /**
     * @param string $DEV_VENDOR_PATH
     */
    public static function setDEVVENDORPATH($DEV_VENDOR_PATH)
    {
        self::$DEV_VENDOR_PATH = $DEV_VENDOR_PATH;
    }
}