<?php

class Tester
{
    const EXECUTABLE_FILENAME = 'index.php';
    const OUTPUT_FILENAME = 'output.txt';
    const DELIMITER = ':';

    public function startTesting($inputFile) {
        $handleInput = fopen($inputFile, 'r');
        $handleOutput = fopen(self::OUTPUT_FILENAME, 'w');
        while (($inputLine = fgets($handleInput)) !== false ) {
            list($argv, $expectedResult) = explode(self::DELIMITER, $inputLine);
            if (trim($this->runTest($argv)) == trim($expectedResult)) {
                fwrite($handleOutput, "successful\n");
            } else {
                fwrite($handleOutput, "error\n");
            }
        }
        fclose($handleInput);
        fclose($handleOutput);
    }

    private function runTest($argv) {
        return shell_exec('php ' . self::EXECUTABLE_FILENAME . " $argv");
    }
}
$tester = new Tester();
$tester->startTesting($argv[1]);