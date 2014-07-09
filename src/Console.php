<?php
/**
 * @link http://github.com/darkair/yii2-console/
 * @copyright Copyright (c) 2014
 */

namespace console;

use yii\helpers\BaseConsole;

/**
 * Console helper provides useful methods for command line related tasks such as getting input or formatting and coloring
 * output.
 *
 * @author Dmitry DarkAiR Romanov <darkair@list.ru>
 */
class Console extends BaseConsole
{
    static private $indent = 0;

    /**
     * Output colored string
     * @param string $string
     * @return integer|boolean number of bytes printed or false on error.
     */
    public static function outputColored($string, $useEol = true)
    {
        return static::stdout(self::renderColoredString($string).($useEol ? PHP_EOL : ''));
    }

    /**
     * Prints text to STDERR appended with a carriage return (PHP_EOL).
     * @param string $string the text to print
     * @return integer|boolean number of bytes printed or false on error.
     */
    public static function error($string = null)
    {
        return parent::error(self::renderColoredString("%r{$string}%n"));
    }

    /**
     * Prints text to STDOUT like warning with a carriage return.
     * @param string $string the text to print
     * @return integer|boolean number of bytes printed or false on error.
     */
    static public function warning($string)
    {
        return self::output(self::renderColoredString("%y{$string}%n"));
    }

    /**
     * Prints text to STDOUT like warning with a carriage return.
     * @param string $string the text to print
     * @return integer|boolean number of bytes printed or false on error.
     */
    static public function annotation($string)
    {
        return self::output(self::renderColoredString("%w{$string}%n"));
    }

    /**
     * Prints end of line
     * @return integer|boolean number of bytes printed or false on error.
     */
    static public function eol()
    {
        return self::output(' ');
    }

    /**
     * Prints ok
     * @return integer|boolean number of bytes printed or false on error.
     */
    static public function ok()
    {
        return self::output(self::renderColoredString("%gOK!%n"));
    }

    /**
     * Prints a string to STDOUT.
     *
     * @param string $string the string to print
     * @return int|boolean Number of bytes printed or false on error
     */
    public static function stdout($string)
    {
        $indentStr = str_repeat('  ', self::$indent);
        return parent::stdout($indentStr.$string);
    }

    /**
     * Add indent
     */
    static public function addIndent()
    {
        self::$indent++;
    }

    /**
     * Remove indent
     */
    static public function removeIndent()
    {
        if (self::$indent > 0)
            self::$indent--;
    }

    /**
     * Remove all indents
     */
    static public function clearIndent()
    {
        self::$indent = 0;
    }
}
