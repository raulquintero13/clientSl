<?php

use Core\Kernel\VarDumper;

if (!function_exists('d')) {
    /**
     * Dump the passed variables
     *
     * @param  array
     * @return void
     */
    function debugData($data)
    {
        if (getenv("APP_ENV") == 'dev') {
            echo "<br><br><br>";
            echo "<div style='text-align: left;'>Debug Data<pre>";
            foreach ($data as $key => $value) {
                    var_export([$key=>$value]);
                echo "<br>";
            }
            echo "</pre></div>";
        }
    }
}

if (!function_exists('d')) {
    /**
     * Dump the passed variables
     *
     * @param  mixed
     * @return void
     */
    function d()
    {
        array_map(
            function ($x) {
                (new VarDumper())->dump($x);
            },
            func_get_args()
        );
    }
}

function toInt($str)
{
    return preg_replace("/([^0-9\\.])/i", "", $str);
}

if (!function_exists('dd')) {
    /**
     * Dump the passed variables
     *
     * @param  mixed
     * @return void
     */
    function dd()
    {
        array_map(
            function ($x) {
                (new VarDumper)->dump($x);
            },
            func_get_args()
        );

        die();
    }
}

if (!function_exists('env')) {
    /**
     * Gets the value of an environment variable
     *
     * @param  string $key
     * @param  mixed $default
     * @return mixed
     */
    function env($key, $default = null)
    {
        $value = getenv($key);

        if ($value === false) {
            return $default;
        }

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;
            case 'false':
            case '(false)':
                return false;
            case 'empty':
            case '(empty)':
                return '';
            case 'null':
            case '(null)':
                return null;
        }

        $strLen = strlen($value);

        if ($strLen > 1 && $value[0] === '"' && $value[$strLen - 1] === '"') {
            return substr($value, 1, -1);
        }

        return $value;
    }
}

if (!function_exists('base_path')) {
    /**
     * Get the path to the base folder
     *
     * @return string
     */
    function base_path()
    {
        return dirname(__DIR__);
    }
}

if (!function_exists('app_path')) {
    /**
     * Get the path to the application folder
     *
     * @return string
     */
    function app_path()
    {
        return base_path() . '/app';
    }
}

if (!function_exists('api_path')) {
    /**
     * Get the path to the application folder
     *
     * @return string
     */
    function api_path()
    {
        return base_path() . '/api';
    }
}

if (!function_exists('apiDesktop_path')) {
    /**
     * Get the path to the application folder
     *
     * @return string
     */
    function apiDesktop_path()
    {
        return base_path() . '/apiDesktop';
    }
}


if (!function_exists('config_path')) {
    /**
     * Get the path to the config folder
     *
     * @return string
     */
    function config_path()
    {
        return base_path() . '/config';
    }
}

if (!function_exists('public_path')) {
    /**
     * Get the path to the public folder
     *
     * @return string
     */
    function public_path()
    {
        return base_path() . '/public';
    }
}

if (!function_exists('storage_path')) {
    /**
     * Get the path to the storage folder
     *
     * @return string
     */
    function storage_path()
    {
        return base_path() . '/storage';
    }
}
