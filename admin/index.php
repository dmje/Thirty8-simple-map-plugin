<h2>Plugin homepage</h2>

<p>Hey look, I'm the plugin homepage</p>

<?php 

$test = get_field('some_field','options');

echo '<p>The value from the plugin settings page is <strong>' . $test . '</strong></p>';

?>