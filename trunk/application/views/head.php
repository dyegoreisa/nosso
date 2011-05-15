<link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/theme/south-street/jquery-ui-1.8.11.custom.css" />
<link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/theme/nosso.css" />
<script type="text/javascript" src="http://<?= $_SERVER['HTTP_HOST']; ?>/javascript/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="http://<?= $_SERVER['HTTP_HOST']; ?>/javascript/jquery-ui-1.8.11.custom.min.js"></script>
<script type="text/javascript" src="http://<?= $_SERVER['HTTP_HOST']; ?>/javascript/jquery.cookie.js"></script>
<script type="text/javascript" src="http://<?= $_SERVER['HTTP_HOST']; ?>/javascript/livequery/jquery.livequery.js"></script>
<script type="text/javascript" src="http://<?= $_SERVER['HTTP_HOST']; ?>/javascript/jquery.ui.datepicker-pt-BR.js"></script>
<script type="text/javascript" src="http://<?= $_SERVER['HTTP_HOST']; ?>/javascript/behavior/principal.js"></script>
<?php if (isset($js) && is_array($js)): ?>
    <script type="text/javascript" src="http://<?= $_SERVER['HTTP_HOST']; ?>/javascript/behavior/<?= $js[1]; ?>.js"></script>
<? elseif (isset($js) && $js === TRUE): ?>
    <script type="text/javascript" src="http://<?= $_SERVER['HTTP_HOST']; ?>/javascript/behavior/<?= $template; ?>.js"></script>
<?php endif; ?>
