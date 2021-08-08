<?php

namespace Speckl\Laravel;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
use Mockery;
use Speckl\ScopeTrait;

class Scope extends TestCase {
  use ScopeTrait, RefreshDatabase;

  public function beforeCallback() {
    Mockery::close();
    parent::setUp();
  }

  public function afterCallback() {
    parent::tearDown();
  }

  public function createApplication() {
    $app = require __DIR__.'/../../../../../../bootstrap/app.php';
    $app->make(Kernel::class)->bootstrap();
    return $app;
  }
}
