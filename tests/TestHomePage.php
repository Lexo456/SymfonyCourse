<?php
 namespace App\Tests;

 use Symfony\Bundle\FrameworkBundle\Test\WebTestCase

 class TestHomePage extends WebTestCase{
     public function testHomePage():void
     {
         $client = static::createClient();
         $client->request('GET', '/');

     }
 }