<?php

namespace PHPStan\Command;

interface AnalysisResult
{
    public function getFileSpecificErrors(): array;
}