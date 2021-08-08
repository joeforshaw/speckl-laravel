<?php

use Speckl\Config;
use Speckl\Laravel\ExampleBlock;
use Speckl\Laravel\GroupBlock;

Config::set('groupBlockClass', GroupBlock::class);
Config::set('exampleBlockClass', ExampleBlock::class);
