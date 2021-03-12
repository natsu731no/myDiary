<?php

class Time{

    public function getTime(){

        $timestump = time();

        return date("Y/m/d", $timestump);
    }
}