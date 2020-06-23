<?php

namespace PHPStan\Command\ErrorFormatter;

interface ErrorFormatter
{

    /**
    * Formats the errors and outputs them to the console.
    *
    * @param \PHPStan\Command\AnalysisResult $analysisResult
    * @param \PHPStan\Command\Output $style
    * @return int Error code.
    */
    public function formatErrors(
    \PHPStan\Command\AnalysisResult $analysisResult,
    \PHPStan\Command\Output $output
    ): int;

}