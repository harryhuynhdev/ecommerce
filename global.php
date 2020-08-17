<?php 
$allproduct=4;
if (!function_exists('dd')) {
    function dd(...$vars)
    {
        foreach ($vars as $var) {
            echo '<code>';
            var_dump(htmlentities($var));
            echo '</code>';
        }
        die;
    }
}

?> 