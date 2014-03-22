<?php

$link = mysql_connect(DB_TOOL_HOST, DB_TOOL_USER, DB_TOOL_PASS) or die("<pre>" . __FILE__ . "\n\r" . mysql_error() . "</pre>");

mysql_select_db(DB_TOOL_NAME, $link) or die("<pre>" . __FILE__ . "\n\r" . mysql_error() . "</pre>");

?>