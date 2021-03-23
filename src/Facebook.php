<?php

namespace clover\Facebook;

use Illuminate\Support\Arr;
use clover\Facebook\Traits\MeTrait;
use clover\Facebook\Traits\PostTrait;
use Facebook\Facebook as FacebookApi;
use clover\Facebook\Traits\LoginTrait;
use clover\Facebook\Traits\AccountTrait;
use clover\Facebook\Traits\AccessTokenTrait;


class Facebook
{
  use AccessTokenTrait, LoginTrait, MeTrait, AccountTrait, PostTrait;

  protected $fb;

  protected $fields = ['id', 'name', 'email'];


  public function __construct()
  {
    $config = [
      'app_id' => config('facebook.app_id'),
      'app_secret' => config('facebook.app_secret'),
      'default_graph_version' => config('facebook.version'),
      'default_access_token' => config('facebook.default_access_token'),
    ];


    $this->fb = new FacebookApi($config);

    $this->loginCallbackUrl(config('facebook.login_callback_url'));
  }

 
  public function fields(...$fields)
  {
    $this->fields = Arr::flatten($fields);

    return $this;
  }

  protected function getPath($path) {
    return  $path. '?fields=' . implode(',', $this->fields);
  }
  
}
