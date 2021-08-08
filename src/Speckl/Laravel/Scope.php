<?php

namespace Speckl\Laravel;

use Illuminate\Foundation\Testing\TestCase;
use Speckl\ScopeTrait;

class Scope extends TestCase {
  use ScopeTrait;

  public function createApplication() {
    $app = require __DIR__.'/../../../../../../bootstrap/app.php';
    $app->make(Kernel::class)->bootstrap();
    return $app;
  }
}
