<?php

namespace Speckl\Laravel;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
use Mockery;
use Speckl\BlockTrait;
use Speckl\ExampleBlockTrait;
use Speckl\RunnableBlock;

class ExampleBlock extends TestCase implements RunnableBlock {
  use BlockTrait, ExampleBlockTrait, RefreshDatabase;

  public function __construct($args) {
    $this->initialise($args);

    if ($this->isRootBlock()) {
      $this->initialiseLaravel();
    }
  }

  public function createApplication() {
    $app = require __DIR__.'/../../../../../../bootstrap/app.php';
    $app->make(Kernel::class)->bootstrap();
    return $app;
  }

  public function app() {
    return $this->app ?? $this->parent->app();
  }

  private function initialiseLaravel() {
    $this->app = $this->createApplication();
    $this->addBeforeCallback(function() {
      Mockery::close();
      parent::setUp();
    });
    $this->addAfterCallback(function() {
      parent::tearDown();
    });
  }
}
