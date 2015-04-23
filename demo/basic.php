<?php

require_once "../src/h.php";

use \HtmlHelper as h;

h\H::doctype(h\H::DOCTYPE_HTML5);
h\H::html(
        h\H::head(
                h\H::title(h\H::_("HtmlHelper Demo")) .
                h\H::metaDesc(h\H::_("HtmlHelper Demo App"))
        ) .
        h\H::body(
                h\H::div(
                        h\H::span(h\H::_("Text inside span"))
                ) .
                h\H::div(h\H::_("Text outside span inside another div"))
        )
        , array(), array("print" => true)
);
