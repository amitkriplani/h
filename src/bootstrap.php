<?php

namespace HtmlHelperBootstrap;

require_once 'h.php';

class H extends \HtmlHelper\H {

    protected function container($text) {
        return $this->div($text, array('class' => 'container'));
    }

    protected function navbar($links, $options = array(), $opts = array()) {
        if (empty($opts['class'])) {
            $opts['class'] = 'navbar';
        } else {
            $opts['class'] .= ' navbar';
        }
        if (!empty($options['position'])) {
            switch ($options['position']) {
                case "top":
                    $opts['class'] .= ' navbar-fixed-top';
                    break;
            }
        }
        $li = $this->navli($links);

        if (!empty($options['inverse'])) {
            $opts['class'] .= ' navbar-inverse';
        }
        if (empty($options['icon-bar-count'])) {
            $opts['icon-bar-count'] = 3;
        }
        return $this->nav(
                        $this->container(
                                $this->div(
                                        $this->button(
                                                $this->span(self::_("Toggle"), array('class' => 'sr-only')) .
                                                $this->span("", array('class' => 'icon-bar'), array('count' => $options['icon-bar-count']))
                                                , array('class' => 'navbar-toggle collapsed', 'data-target' => "#navbar")) .
                                        $this->a('Bootstrap demo', array('class' => 'navbar-brand'))
                                        , array('class' => 'navbar-header')) .
                                $this->div(
                                        $this->ul(
                                                $li
                                                , array('class' => 'nav navbar-nav'))
                                        , array('class' => 'navbar-collapse collapse', 'id' => 'navbar'))
                        )
                        , $opts);
    }

    protected function navli($links) {
        $li = '';
        foreach ($links as $link) {
            if (empty($link['type'])) {
                $link['type'] = 'link';
            }
            if (empty($link['opts'])) {
                $link['opts'] = array();
            }
            switch ($link['type']) {
                case "link":
                    $li .= $this->li($this->a(self::_($link['text']), array('href' => $link['url'])), $link['opts']);
                    break;
                case "dropdown":
                    $li .= $this->li($this->a(
                                    self::_($link['text']) .
                                    $this->span('', array('class' => 'caret'))
                                    , array(
                                'href' => '#',
                                'class' => 'dropdown-toggle',
                                'data-toggle' => 'dropdown',
                                    )
                            ) . $this->ul($this->navli($link['children']), array('class' => 'dropdown-menu'))
                            , array('class' => 'dropdown'));
                    break;
                case "header":
                    $li .= $this->li(self::_($link['text']), array('class' => 'dropdown-header'));
                    break;
                case "divider":
                    $li .= $this->li('', array('class' => 'divider'));
                    break;
            }
        }
        return $li;
    }

    protected function jumbotron($h1, $text) {
        return $this->div($this->h1($h1) . $text, array('class' => 'jumbotron'));
    }

}
