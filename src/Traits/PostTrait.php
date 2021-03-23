<?php

namespace clover\Facebook\Traits;

use clover\Facebook\Objects\Feed\Feed;

trait PostTrait
{
  public function posts($after = null,  $limit = 10, $fields = ['id', 'message', 'full_picture', 'created_time'])
  {
    $this->fields($fields);

    try {
      $response = $this->fb->get($this->getPath('/me/posts') . "&limit=$limit&after=$after", $this->getToken());
      $edge = $response->getGraphEdge();
      return [
        'data' => $edge->asArray(),
        'meta' => $edge->getMetaData()
      ];
    } catch (\Exception $e) {
      throw $e;
    }
  }

  public function feed()
  {
    return new Feed($this->fb, $this->getToken());
  }
}
