<?php

/**
 * @author Amit Kriplani <amitkriplani@ymail.com>
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @copyright (c) 2015, Amit Kriplani
 * @link https://github.com/amitkriplani/h GitHub URL
 * @package h
 */

namespace HtmlHelper;

class H {

    protected $output = '';
    protected static $instance;

    const DOCTYPE_HTML5 = "html5";

    protected function metaDesc($desc) {
        return $this->prepareTag('meta', "", array(
                    'name' => 'description',
                    'content' => $desc
                        ), array('selfClose' => true)) .
                $this->prepareTag('meta', "", array(
                    'name' => 'og:description',
                    'content' => $desc
                        ), array('selfClose' => true));
    }

    public function __construct() {
        ob_start(array($this, 'printAll'));
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    protected function doctype($doctype) {
        if ('' !== self::getInstance()->output) {
            throw new \Exception("DOCTYPE has to be set before everything else.", 500);
        }
        $return = "";
        switch ($doctype) {
            case self::DOCTYPE_HTML5:
                $return = "<!DOCTYPE html>";
                break;
            default:
                throw new \Exception('Invalid doctype requested.', 500);
                break;
        }
        print $return;
    }

    public static function __callStatic($name, $arg) {
        $trace = debug_backtrace();
        if (!is_array($arg) || empty($arg)) {
            $arg = array();
        }
        if (empty($arg[0])) {
            $arg[0] = "";
        }
        if (empty($arg[1])) {
            $arg[1] = array();
        }
        if (empty($arg[2])) {
            $arg[2] = array();
        }
        $self = self::getInstance();
        if (!method_exists($self, $name)) {
            array_unshift($arg, $name);
            $name = 'prepareTag';
        }
        return call_user_method_array($name, $self, $arg);
    }

    protected function prepareTag($tag, $text = "", $attrs = array(), $opts = array()) {
        $output = "<" . $tag;
        foreach ($attrs as $attr => $val) {
            if (is_array($val)) {
                $output .= " $attr='";
                foreach ($val as $key => $value) {
                    $output .= "$key:$value;";
                }
                $output .= "'";
            } else {
                $output .= " $attr='$val'";
            }
        }
        if (!empty($opts['selfClose'])) {
            if (empty($attrs['value']) && !empty($text)) {
                $output .= "value='$text' ";
            }
            $output .= '/>';
        } else {
            $output .= ">$text</$tag>";
        }
        if (!empty($opts['print']))
            print $output;
        else
            return $output;
    }

    public static function _($text) {
        return htmlentities($text);
    }

    public function printAll() {
        return ob_get_contents() . $this->output;
    }

}

//EOF

        