<?php

namespace clover\Facebook\Traits;

use Illuminate\Support\Arr;

trait LoginTrait
{
  protected $permissions = ['email'];

  protected $login_callback_url = '';


  public function permissions(...$permissions)
  {
    $this->permissions = Arr::flatten($permissions);

    return $this;
  }

  public function loginCallbackUrl($url)
  {
    $this->login_callback_url = $url;

    return $this;
  }

  public function getRedirectLoginHelper()
  {
    return $this->fb->getRedirectLoginHelper();
  }

  public function getJavaScriptHelper()
  {
    return $this->fb->getJavaScriptHelper();
  }

  public function login()
  {
    if (request()->has('code'))
      return $this->handleLogin();

    return $this->getRedirectLoginHelper()
      ->getLoginUrl(
        $this->login_callback_url,
        $this->permissions
      );
  }

  public function required()
  {
    return $this->login();
  }

  public function handleLogin()
  {
    try {
      $helper = $this->getRedirectLoginHelper();

      $access_token = $helper->getAccessToken();
    } catch (\Exception $e) {
      \Log::error($e->getMessage());
      return redirect('/login');
    }

    $oAuth2Client = $this->getOAuth2Client();

    $oAuth2Client->getLongLivedAccessToken($access_token);

    return $access_token->getValue();
  }

  protected function getOAuth2Client()
  {
    return $this->fb->getOAuth2Client();
  }
}
