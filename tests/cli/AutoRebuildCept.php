<?php 
$I = new CliGuy($scenario);
$I->wantTo('change configs and check that Actor is rebuilt');
$I->amInPath('tests/data/sandbox');
$I->deleteFile('tests/_support/CodeGuy.php');
$I->writeToFile('tests/unit.suite.yml', <<<EOF
class_name: CodeGuy
modules:
    enabled: [Cli, CodeHelper]
EOF
);
$I->executeCommand('run unit PassingTest.php --debug');
$I->seeInShellOutput('Cli');
$I->seeFileFound('tests/_support/_generated/CodeGuyActions.php');
$I->seeInThisFile('public function seeInShellOutput');
$I->seeInThisFile('public function runShellCommand');
$I->seeFileFound('tests/_support/CodeGuy.php');
$I->seeInThisFile('class CodeGuy extends \Codeception\Actor');
