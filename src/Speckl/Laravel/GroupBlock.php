<?php

namespace Speckl\Laravel;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Speckl\BlockTrait;
use Speckl\GroupBlockTrait;
use Speckl\LoadableBlock;
use Speckl\RunnableBlock;

class GroupBlock implements LoadableBlock, RunnableBlock {
  use BlockTrait, GroupBlockTrait, RefreshDatabase;

  public function app() {
    return $this->app ?? $this->parent->app();
  }

  private function initialiseLaravel() {
    $this->addBeforeCallback(function() {
      Mockery::close();
      parent::setUp();
    });
    $this->addAfterCallback(function() {
      parent::tearDown();
    });
  }
}
