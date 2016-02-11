<?php
  class Tamagotchi
  {
    private $name;
    private $food;
    private $attention;
    private $rest;

    function __construct($name)
    {
      $this->name = $name;
      $this->food = 100;
      $this->attention = 100;
      $this->rest = 100;
    }

    function getName()
    {
      return $this->name;
    }
    function getFood()
    {
        return $this->food;
    }

    function getAttention()
    {
        return $this->attention;
    }

    function getRest()
    {
        return $this->rest;
    }

    function feed()
    {
      $this->food += 10;
    }
    function play()
    {
      $this->attention += 10;
    }
    function sleep()
    {
      $this->rest += 10;
    }

    function save()
    {
      array_push($_SESSION['tamagotchi-status'], $this);
    }

    static function getAll()
    {
      return $_SESSION['tamagotchi-status'];
    }

    static function passTheTime()
    {
      foreach($_SESSION['tamagotchi-status'] as $tammy){
        $tammy->food -=  10;
        $tammy->attention -= 10;
        $tammy->rest -= 10;
      }
    }
    
    static function clear()
    {
      $_SESSION['tamagotchi-status'] = array();
    }
  }
?>
