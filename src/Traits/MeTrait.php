<?php

namespace clover\Facebook\Traits;

trait MeTrait
{

  public function me()
  {
    try {
      
      $response = $this->fb->get($this->getPath('/me'), $this->getToken());

      return $response->getGraphUser()->asArray();
    } catch (\Exception $e) {
      throw $e;
    }
  }

  
}