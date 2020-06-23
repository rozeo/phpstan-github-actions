<?php

namespace PHPStan\Command\Symfony;

interface SymfonyOutput
{
    public function writeFormatted(string $message);
    public function writeLineFormatted(string $message);
    public function writeRaw(string $message);
}