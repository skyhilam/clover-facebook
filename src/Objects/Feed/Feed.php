<?php

namespace clover\Facebook\Objects\Feed;

use clover\Facebook\Traits\AccessTokenTrait;
use Exception;
use Illuminate\Support\Arr;


class Feed
{
  use AccessTokenTrait;

  protected $fb;

  protected $message;
  protected $url;
  protected $link;

  public function __construct($fb)
  {
    $this->fb = $fb;
  }

  public function message($message)
  {
    if (($link = $this->getLinkFromMessage($message)) && empty($this->link)) {
      $this->link($link);
    }

    $this->message = $message;
    return $this;
  }

  public function url($url)
  {
    $this->url = $url;
    return $this;
  }

  public function hasUrl()
  {
    return !empty($this->url);
  }

  public function link($link)
  {
    $this->link = $link ?? $this->link;
    return $this;
  }

  public function send()
  {
    $path = $this->getPath();
    $data = $this->data();

    try {
      $this->fb->post($path, $data, $this->getToken());
    } catch (Exception $e) {
      throw $e;
    }
  }

  protected function data()
  {
    if ($this->hasUrl()) {
      return [
        'caption' => $this->message,
        'url' => $this->url,
      ];
    }

    return [
      'message' => $this->message,
      'link' => $this->link,
    ];
  }

  protected function getPath()
  {
    if ($this->hasUrl())
      return '/me/photos';

    return '/me/feed';
  }

  protected function getLinkFromMessage($message)
  {
    $reg_exUrl = "/(http|https)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
    preg_match_all($reg_exUrl, $message, $result, PREG_PATTERN_ORDER);

    return Arr::first(Arr::first($result));
  }
}
