<?php

require_once "../src/h.php";

use \HtmlHelper as h;

h\H::doctype(h\H::DOCTYPE_HTML5);
h\H::html(
        h\H::head(
                h\H::title(h\H::_("HtmlHelper Form Demo")) .
                h\H::metaDesc(h\H::_("Describes how to use HtmlHelper for an HTML form"))
        ) .
        h\H::body(
                h\H::div(
                        h\H::form(
                                h\H::textbox('textbox', "") .
                                h\H::password('password', "") .
                                h\H::textarea(h\H::_('textarea'), array('name' => 'textarea')) .
                                h\H::checkbox('checkbox', "1") .
                                h\H::checkbox('checkbox', "0") .
                                h\H::fieldset(
                                        h\H::legend(h\H::_('radio buttons')) .
                                        h\H::radio('radio', "yes") .
                                        h\H::radio('radio', "no")
                                ) .
                                h\H::select("demo", array(
                                    "Opt1" => "Option1",
                                    "Opt2" => "Option2",
                                    "Opt3" => "Option3"
                                )) .
                                h\H::submit('submit')
                        )
                )
        )
        , array(), array("print" => true)
);
