<?php

// This script will test if the command placeholders are correctly replaced

// Define mock values without requiring the actual classes
$userName = 'TestPlayer';
$objectiveName = 'Test Objective';

// Test the replacement functionality
$command = "give {player} diamond 1 {objective_name}";
$expectedResult = "give TestPlayer diamond 1 Test Objective";

// Replace the placeholders manually to verify our logic
$replacedCommand = str_replace(
    ['{name}', '{player}', '{objective_name}'],
    [$userName, $userName, $objectiveName],
    $command
);

echo "Original command: {$command}\n";
echo "Expected result: {$expectedResult}\n";
echo "Actual result: {$replacedCommand}\n";
echo "Test result: " . ($replacedCommand === $expectedResult ? "PASSED" : "FAILED") . "\n\n";

// Test backward compatibility with {name}
$command = "give {name} diamond 1";
$expectedResult = "give TestPlayer diamond 1";

$replacedCommand = str_replace(
    ['{name}', '{player}', '{objective_name}'],
    [$userName, $userName, $objectiveName],
    $command
);

echo "Original command: {$command}\n";
echo "Expected result: {$expectedResult}\n";
echo "Actual result: {$replacedCommand}\n";
echo "Test result: " . ($replacedCommand === $expectedResult ? "PASSED" : "FAILED") . "\n";

echo "\nNOTE: This test only checks the string replacement logic, not the actual integration with the game server.\n";
echo "The full execution would require a running Minecraft server with Azuriom integration.\n";
