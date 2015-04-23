<?php

require_once "../src/bootstrap.php";

use \HtmlHelperBootstrap as h;

h\H::doctype(h\H::DOCTYPE_HTML5);
h\H::html(
        h\H::head(
                h\H::title(h\H::_("HtmlHelperBootstrap Demo")) .
                h\H::metaDesc(h\H::_("Describes how to use HtmlHelperBootstrap")) .
                h\H::link("stylesheet", "http://getbootstrap.com/dist/css/bootstrap.min.css") .
                h\H::link("stylesheet", "http://getbootstrap.com/dist/css/bootstrap-theme.min.css") .
                h\H::link("stylesheet", "http://getbootstrap.com/examples/theme/theme.css")
        ) .
        h\H::body(
                h\H::navbar(array(//This array would come from a database later!
                    array('url' => '#', 'text' => 'Home', 'opts' => array('class' => 'active')),
                    array('url' => '#about', 'text' => 'About',),
                    array('url' => '#contact', 'text' => 'Contact',),
                    array('text' => 'Dropdown', 'type' => 'dropdown',
                        'children' => array(
                            array('url' => '#', 'text' => 'Action',),
                            array('url' => '#', 'text' => 'Another Action'),
                            array('url' => '#', 'text' => 'Something else here',),
                            array('type' => 'divider'),
                            array('type' => 'header', 'text' => 'Nav header'),
                            array('url' => '#', 'text' => 'Separated link',),
                            array('url' => '#', 'text' => 'One more separated link',),
                        )
                    ),
                        ), array('position' => 'top', 'inverse' => true, 'icon-bar-count' => 4)
                ) .
                h\H::container(
                        h\H::jumbotron("Bootstrap example", h\H::p(h\H::_("This is a template showcasing the optional theme stylesheet included in Bootstrap. Use it as a starting point to create something more unique by building on or modifying it."))) .
                        h\H::div(h\H::h1(h\H::_("Buttons")), array('class' => 'page-header')) .
                        h\H::p(
                                h\H::button('Default', array('class' => 'btn btn-lg btn-default')) .
                                h\H::button('Primary', array('class' => 'btn btn-lg btn-primary')) .
                                h\H::button('Success', array('class' => 'btn btn-lg btn-success')) .
                                h\H::button('Info', array('class' => 'btn btn-lg btn-info')) .
                                h\H::button('Warning', array('class' => 'btn btn-lg btn-warning')) .
                                h\H::button('Danger', array('class' => 'btn btn-lg btn-danger')) .
                                h\H::button('Link', array('class' => 'btn btn-lg btn-link'))
                        ) .
                        h\H::p(
                                h\H::button('Default', array('class' => 'btn btn-default')) .
                                h\H::button('Primary', array('class' => 'btn btn-primary')) .
                                h\H::button('Success', array('class' => 'btn btn-success')) .
                                h\H::button('Info', array('class' => 'btn btn-info')) .
                                h\H::button('Warning', array('class' => 'btn btn-warning')) .
                                h\H::button('Danger', array('class' => 'btn btn-danger')) .
                                h\H::button('Link', array('class' => 'btn btn-link'))
                        ) .
                        h\H::p(
                                h\H::button('Default', array('class' => 'btn btn-sm btn-default')) .
                                h\H::button('Primary', array('class' => 'btn btn-sm btn-primary')) .
                                h\H::button('Success', array('class' => 'btn btn-sm btn-success')) .
                                h\H::button('Info', array('class' => 'btn btn-sm btn-info')) .
                                h\H::button('Warning', array('class' => 'btn btn-sm btn-warning')) .
                                h\H::button('Danger', array('class' => 'btn btn-sm btn-danger')) .
                                h\H::button('Link', array('class' => 'btn btn-sm btn-link'))
                        ) .
                        h\H::p(
                                h\H::button('Default', array('class' => 'btn btn-xs btn-default')) .
                                h\H::button('Primary', array('class' => 'btn btn-xs btn-primary')) .
                                h\H::button('Success', array('class' => 'btn btn-xs btn-success')) .
                                h\H::button('Info', array('class' => 'btn btn-xs btn-info')) .
                                h\H::button('Warning', array('class' => 'btn btn-xs btn-warning')) .
                                h\H::button('Danger', array('class' => 'btn btn-xs btn-danger')) .
                                h\H::button('Link', array('class' => 'btn btn-xs btn-link'))
                        ) .
                        h\H::div(h\H::h1(h\H::_("Table")), array('class' => 'page-header'))
                )
        )
        , array(), array("print" => true)
);
