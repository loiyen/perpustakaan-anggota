<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('format_jam_indonesia')) {
    function format_jam_indonesia($datetime)
    {
        $jam = date('H', strtotime($datetime));
        $menit = date('i', strtotime($datetime));
        $detik = date('s', strtotime($datetime));

        return $jam . ':' . $menit . ':' . $detik;
    }
}
