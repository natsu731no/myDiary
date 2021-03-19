<?php

class Time{

    public function getTime(){

        $timestump = new DateTime();

        return $timestump->setTimeZone(new DateTimeZone('Asia/Tokyo'))->format('Y/m/d');
        // return date("Y/m/d G:i", $timestump);
    }
}