<?php
$this->Html->css(array('jHtmlArea'), null, array('inline'=>false));
$this->Html->script(array('jHtmlArea-0.7.5.min'), array('inline'=>false));
$this->html->scriptBlock('$(function() { wysiwyg("'.$element.'", "'.@$style.'"); });', array('inline'=>false));
?>