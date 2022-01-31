<?php
require("1.jpg");
require("2.jpg");

if (sizeof($argv) != 2 || !is_numeric($argv[1]) || $argv[1] < 0 || $argv[1] > 2.5)
    help();
process($argv[1]);
exit(0);

/*