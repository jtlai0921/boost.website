<?php
/*
  Copyright 2005-2008 Redshift Software, Inc.
  Distributed under the Boost Software License, Version 1.0.
  (See accompanying file LICENSE_1_0.txt or http://www.boost.org/LICENSE_1_0.txt)
*/

class BoostFilterAsciidoctor extends BoostFilter
{
    function echo_filtered()
    {
        $text = $this->content;

        $match = null;

        if(preg_match('@(?:</head>\s*)?<body[^>]*>@is', $text, $match, PREG_OFFSET_CAPTURE)) {
            echo $this->alter_title(substr($text, 0, $match[0][1]));
            echo '<link rel="icon" href="/favicon.ico" type="image/ico">';
            echo '<link rel="stylesheet" type="text/css" href="/style-v2/section-basic.css">';
            echo '<style>';
            echo '#boost-common-heading-doc { position: static; }';
            echo '#boost-common-heading-doc-spacer { display: none; }';
            echo '</style>';
            echo $match[0][0];
            virtual("/common/heading-doc.html");
            echo latest_link($this->data);
            echo $this->prepare_html(substr($text, $match[0][1] + strlen($match[0][0])));
        }
        else {
            echo $text;
        }
    }
}
