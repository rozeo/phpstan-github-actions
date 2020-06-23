<?php

namespace PHPStan\Command;

interface AnalysisResult
{
    public function getFileSpecificErrors(): array;
    public function hasErrors(): bool;
    public function getTotalErrorsCount(): int;
    public function getNotFileSpecificErrors(): array;
    public function getWarnings(): array;
    public function hasWarnings(): bool;
    public function isDefaultLevelUsed(): bool;
    public function getProjectConfigFile(): string;
    public function hasInternalErrors(): bool;
}