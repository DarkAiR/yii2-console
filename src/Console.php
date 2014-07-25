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
    private static $indent = 0;
    private static $isNewLine = true;       // Is line new? If yes than add indent

    /**
     * Prints text to STDOUT appended with a carriage return (PHP_EOL).
     *
     * @param  string          $string the text to print
     * @return integer|boolean number of bytes printed or false on error.
     */
    public static function output($string = null, $useEol = true)
    {
        $r = static::stdout($string.($useEol ? PHP_EOL : ''));
        self::$isNewLine = $useEol;
        return $r;
    }

    /**
     * Output colored string
     * @param  string          $string
     * @return integer|boolean number of bytes printed or false on error.
     */
    public static function outputColored($string, $useEol = true)
    {
        $r = static::stdout(self::renderColoredString($string).($useEol ? PHP_EOL : ''));
        self::$isNewLine = $useEol;
        return $r;
    }

    /**
     * Prints text to STDERR appended with a carriage return (PHP_EOL).
     * @param  string          $string the text to print
     * @return integer|boolean number of bytes printed or false on error.
     */
    public static function error($string = null)
    {
        return parent::error(self::renderColoredString("%r{$string}%n"));
    }

    /**
     * Prints text to STDOUT like warning with a carriage return.
     * @param  string          $string the text to print
     * @return integer|boolean number of bytes printed or false on error.
     */
    public static function warning($string)
    {
        return self::output(self::renderColoredString("%y{$string}%n"));
    }

    /**
     * Prints text to STDOUT like warning with a carriage return.
     * @param  string          $string the text to print
     * @return integer|boolean number of bytes printed or false on error.
     */
    public static function annotation($string)
    {
        return self::output(self::renderColoredString("%w{$string}%n"));
    }

    /**
     * Prints end of line
     * @return integer|boolean number of bytes printed or false on error.
     */
    public static function eol()
    {
        return self::output(' ');
    }

    /**
     * Prints ok
     * @return integer|boolean number of bytes printed or false on error.
     */
    public static function ok()
    {
        return self::output(self::renderColoredString("%gOK!%n"));
    }

    /**
     * Prints a string to STDOUT.
     *
     * @param  string      $string the string to print
     * @return int|boolean Number of bytes printed or false on error
     */
    public static function stdout($string)
    {
        $indentStr = self::$isNewLine ? str_repeat('  ', self::$indent) : '';
        return parent::stdout($indentStr.$string);
    }

    /**
     * Add indent
     */
    public static function addIndent()
    {
        self::$indent++;
    }

    /**
     * Remove indent
     */
    public static function removeIndent()
    {
        if (self::$indent > 0)
            self::$indent--;
    }

    /**
     * Remove all indents
     */
    public static function clearIndent()
    {
        self::$indent = 0;
    }
}
