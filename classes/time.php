<?php

class Time{

    public function getDate(){ 
        $timestamp = new DateTime();

        return $timestamp->setTimeZone(new DateTimeZone('Asia/Tokyo'))->format('Y-m-d');
    }

    public function getDateDay(){
        $timestamp = new DateTime();

        return $timestamp->setTimeZone(new DateTimeZone('Asia/Tokyo'))->format('F d, Y (D)');
    }
}