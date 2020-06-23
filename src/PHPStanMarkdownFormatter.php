<?php

namespace Rozeo\PHPStanAction;

use PHPStan\Analyser\Error;
use PHPStan\Command\Output;

class PHPStanMarkdownFormatter
{
    private $trailingPath;

    public function formatErrors(
        \PHPStan\Command\AnalysisResult $analysisResult,
        \PHPStan\Command\Output $output
    ): int
    {
        $this->trailingPath = dirname($analysisResult->getProjectConfigFile());

        foreach ($arr = $analysisResult->getFileSpecificErrors() as $index => $error) {
            $this->outputError($output, $error);

            if ($index !== array_key_last($arr)) {
                $output->writeRaw("\n----\n\n");
            }
        }

        return intval(count($arr) !== 0);
    }

    protected function outputError(Output $output, Error $error)
    {
        $output->writeRaw("### Error on {$this->trailPath($error->getFile())}:{$error->getLine()}\n");
        $output->writeRaw($error->getMessage() . "\n");
    }

    protected function trailPath(string $path): string
    {
        return str_replace($this->trailingPath, "", $path);
    }
}