<?php

namespace Speckl\Laravel;

use Illuminate\Contracts\Console\Kernel;
use Speckl\BlockTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
use Mockery;

class Block extends TestCase
{
  use BlockTrait, RefreshDatabase;

  public function __construct($label, $body, $parent, $path, $pending)
  {
    $this->initialise($label, $body, $parent, $path, $pending);

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
      $app = require __DIR__.'/../../../../../../bootstrap/app.php';
      $app->make(Kernel::class)->bootstrap();
      return $app;
  }

  public function app()
  {
    return $this->app ?? $this->parent->app();
  }
}
