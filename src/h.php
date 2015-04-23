<?php

/**
 * @author Amit Kriplani <amitkriplani@ymail.com>
 * @license ../LICENSE The MIT License (MIT)
 * @copyright (c) 2015, Amit Kriplani
 * @link https://github.com/amitkriplani/h GitHub URL
 * @package h
 */

namespace HtmlHelper;

class H {

    protected static $instance;

    const DOCTYPE_HTML5 = "html5";

    /**
     * 
     * @todo add more doctypes
     * @var array Declarable doctypes
     */
    protected static $doctypes = array(
        self::DOCTYPE_HTML5 => '<!DOCTYPE html>'
    );

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

    protected function link($rel, $href) {
        return $this->prepareTag('link', "", array(
                    'rel' => $rel,
                    'href' => $href
                        ), array('selfClose' => true));
    }

    protected function checkbox($name, $value, $opts = array()) {
        return $this->input(self::_($name), 'checkbox', $name, $value, $opts);
    }

    protected function radio($name, $value, $opts = array()) {
        return $this->input(self::_($name), 'radio', $name, $value, $opts);
    }

    protected function textbox($name, $value, $opts = array()) {
        return $this->input(self::_($name), 'text', $name, $value, $opts);
    }

    protected function password($name, $value, $opts = array()) {
        return $this->input(self::_($name), 'password', $name, $value, $opts);
    }

    protected function submit($value, $opts = array()) {
        return $this->input(self::_('submit'), 'submit', 'submit', $value, $opts);
    }

    protected function input($label, $type, $name, $value, $opts = array()) {
        $opts['type'] = $type;
        $opts['name'] = $name;
        $opts['value'] = $value;
        return $this->label(
                        $label .
                        $this->prepareTag('input', "", $opts, array('selfClose' => true)));
    }

    protected function select($name, $options) {
        $opts = "";
        if (array_values($options) === $options) {
            $optLabelSameAsValue = true;
        } else {
            $optLabelSameAsValue = false;
        }
        foreach ($options as $val => $opt) {
            if ($optLabelSameAsValue) {
                $opts .= $this->option($opt, array('value' => $opt));
            } else {
                $opts .= $this->option($opt, array('value' => $val));
            }
        }
        return $this->prepareTag('select', $opts, array(
                    'name' => $name
        ));
    }

    public function __construct() {
        ;
    }

    public static function getInstance() {
        if (!self::$instance) {
            $class = get_called_class();
            self::$instance = new $class;
        }
        return self::$instance;
    }

    protected function doctype($doctype) {
        $return = '';
        if (empty(self::$doctypes[$doctype])) {
            throw new \Exception('Invalid doctype requested.', 500);
        }
        print self::$doctypes[$doctype];
    }

    public function __call($name, $arg) {
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
        if (!method_exists($this, $name)) {
            array_unshift($arg, $name);
            $name = 'prepareTag';
        }
        return call_user_method_array($name, $this, $arg);
    }

    public static function __callStatic($name, $arg) {
        $self = self::getInstance();
        return call_user_method_array($name, $self, $arg);
    }

    protected function prepareTag($tag, $text = "", $attrs = array(), $opts = array()) {
        if (empty($opts['count'])) {
            $opts['count'] = 1;
        }
        $output = "";
        for ($i = 0; $i < $opts['count']; $i++) {
            $output .= "<" . $tag;
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
        }
        if (!empty($opts['print']))
            print $output;
        else
            return $output;
    }

    public static function _($text) {
        return htmlentities($text);
    }

}

//EOF