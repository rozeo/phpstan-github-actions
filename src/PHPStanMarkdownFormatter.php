<?php

namespace Rozeo\PHPStanAction;

use PHPStan\Analyser\Error;
use PHPStan\Command\Output;

class PHPStanMarkdownFormatter
{
    /**
     * @var string
     */
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

    protected function outputError(Output $output, Error $error): void
    {
        $hash = getenv('GITHUB_SHA');
        $repository = getenv('GITHUB_REPOSITORY');

        $file = $this->trailPath($error->getFile());

        if ($hash === '' || $repository === '') {
            $output->writeRaw("Error on {$file}:{$error->getLine()}\n");
        } else {
            $output->writeRaw(
                "https://github.com/{$repository}/blob/{$hash}{$file}#L{$error->getLine()}\n"
            );
        }
        $output->writeRaw(
            "#### " .
            $error->getMessage() .
            "\n");
    }

    protected function trailPath(string $path): string
    {
        return str_replace($this->trailingPath, "", $path);
    }
}