<?php
function die_nicely($msg) {
    echo <<<END
	<style>body
{
	background-color: lightblue;
}</style>
<center><div><h3>$msg</h3></div></center>
END;
    exit;
}
?>