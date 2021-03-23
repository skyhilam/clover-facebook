<?php

namespace clover\Facebook\Traits;


trait AccountTrait
{
  public function accounts()
  {
    try {
      $response = $this->fb->get('/me/accounts', $this->getToken());

      return $response->getGraphEdge()->asArray();
    } catch (\Exception $e) {
      throw $e;
    }
  }
}
