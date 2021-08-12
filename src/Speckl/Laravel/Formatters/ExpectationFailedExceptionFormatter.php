<?php

namespace Speckl\Laravel\Formatters;

use Speckl\Exceptions\SpecklException;
use Speckl\Formatters\Formatter;

class ExpectationFailedExceptionFormatter extends Formatter {
  public function format() {
    $traceRow = $this->originatingTraceRow();
    $relativeFilePath = substr(
      $traceRow['file'],
      strlen(getcwd()) + 1 // +1 removes the slash at the start
    );

    $output = $this->exception->getMessage() . "\n\n";
    $output .= $relativeFilePath . ':' . $traceRow['line'];
    return $output;
  }

  private function originatingTraceRow() {
    foreach ($this->exception->getTrace() as $traceRow) {
      $inPHPUnit = strpos($traceRow['class'], 'PHPUnit\Framework') !== false;
      if (!$inPHPUnit) { return $traceRow; }
    }
    throw new SpecklException('Unable to parse PHPUnit exception stack trace');
  }
}
