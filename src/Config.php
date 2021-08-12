<?php

use PHPUnit\Framework\ExpectationFailedException;
use Speckl\Container;
use Speckl\Laravel\Formatters\ExpectationFailedExceptionFormatter;
use Speckl\Laravel\Scope;

Container::set('scopeClass', Scope::class);
Container::set('formatters', [
  ExpectationFailedException::class => ExpectationFailedExceptionFormatter::class
]);
