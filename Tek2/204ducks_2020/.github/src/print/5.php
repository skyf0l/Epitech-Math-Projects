<?php
function print_time($t) {
    echo((int)($t / 60)."m ");
    if (($t % 60) < 10)
        echo("0");
    echo(($t % 60)."s\n");
}

/*