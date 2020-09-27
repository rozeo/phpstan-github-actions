<?php

namespace Rozeo\PHPStanAction;

use PHPStan\Analyser\Error;
use PHPStan\Command\Output;

class PHPStanGithubReviewsJsonFormatter
{
    /**
     * @var string
     */
    private $trailingPath;

    private $formattedErrors;

    public function formatErrors(
        \PHPStan\Command\AnalysisResult $analysisResult,
        \PHPStan\Command\Output $output
    ): int
    {
        $this->formattedErrors = [];
        $this->trailingPath = dirname($analysisResult->getProjectConfigFile());

        /**
         * @var int $index
         * @var Error $error
         */
        foreach ($arr = $analysisResult->getFileSpecificErrors() as $index => $error) {
            $this->formattedErrors[] = [
                'path' => $this->trailPath($error->getFile()),
                'position' => $error->getLine(),
                'body' => $error->getMessage(),
            ];
        }

        $this->outputFormattedErrors();

        return intval(count($this->formattedErrors) !== 0);
    }

    protected function trailPath(string $path): string
    {
        return str_replace($this->trailingPath . "/", "", $path);
    }

    public function getFormattedErrors(): array
    {
        return $this->formattedErrors;
    }

    public function outputFormattedErrors(): void
    {
        echo json_encode($this->formattedErrors);
    }
}