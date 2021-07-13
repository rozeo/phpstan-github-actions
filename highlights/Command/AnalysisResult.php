<?php

namespace PHPStan\Command;

use PHPStan\Analyser\Error;

interface AnalysisResult
{
    public function getFileSpecificErrors(): array;
    public function hasErrors(): bool;
    public function getTotalErrorsCount(): int;

    /**
     * @return Error[]
     */
    public function getNotFileSpecificErrors(): array;

    public function getWarnings(): array;
    public function hasWarnings(): bool;
    public function isDefaultLevelUsed(): bool;
    public function getProjectConfigFile(): string;
    public function hasInternalErrors(): bool;
}