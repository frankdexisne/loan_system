<?php
use Carbon\Carbon;

if(!function_exists('carbon')){
    function carbon($date)
    {
        return Carbon::parse($date);
    }
}

?>
