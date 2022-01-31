<?php
require("6.jpg");
require("17.jpg");
require("18.jpg");

function process_avg_stand($a) {
    p_avg_rt(round(c_avg_rt($a) * 60));
    p_stand_dev(c_stand_dev($a));
}

/*