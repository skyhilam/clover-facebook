<?php


namespace clover\Facebook\Traits;


trait AccessTokenTrait
{
  protected $access_token;

  public function token($access_token)
  {
    $this->access_token = $access_token;
    return $this;
  }

  protected function getToken()
  {
    return $this->access_token;
  }
}