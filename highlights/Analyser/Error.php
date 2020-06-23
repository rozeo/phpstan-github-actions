<?php

namespace PHPStan\Analyser;

interface Error
{
    public function getMessage(): string;
    public function getFile(): string;
    public function getLine(): int;
    public function getCanBeIgnored(): bool;
    public function getFilePath(): string;
    public function getTraitFilePath(): string;
    public function getTip(): string;
    public function getNodeLine(): int;
    public function getNodeType(): string;
    public function getIdentifier(): string;
    public function getMetadata(): array;
}