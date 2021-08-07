<?php

namespace Speckl;

use Speckl\Scope;
use Speckl\BlockTrait;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
use Mockery;

class Block extends TestCase
{
  use BlockTrait, RefreshDatabase;

  private $app;

  public function __construct($label, $body, $parent, $path)
  {
    $this->label = $label;
    $this->parent = $parent;
    $this->scope = new Scope($this->parent ? $this->parent->scope : null);
    $this->body = $body->bindTo($this->scope);
    $this->beforeEachs = $this->parent ? $this->parent->beforeEachs : [];
    $this->afterEachs = $this->parent ? $this->parent->afterEachs : [];
    $this->path = $path;
    if (!$this->parent) {
      $this->app = $this->createApplication();
      $this->addBeforeEach(function() {
        Mockery::close();
        parent::setUp();
      });
      $this->addAfterEach(function() {
        parent::tearDown();
      });
    }
  }

  public function createApplication()
  {
      $app = require __DIR__.'/../../../../bootstrap/app.php';

      $app->make(Kernel::class)->bootstrap();

      return $app;
  }

  public function app()
  {
    return $this->app ?? $this->parent->app();
  }
}
