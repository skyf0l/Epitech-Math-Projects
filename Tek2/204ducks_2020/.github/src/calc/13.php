<?php
function fd($a, $t) {
    return (-$a * exp(-$t)) - (4 - 3 * $a) / 2 * exp(-2 * $t) - (2 * $a - 4) / 4 * exp(-4 * $t);
}

/*