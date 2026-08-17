<?php

use Azuriom\Plugin\Gamify\Controllers\ObjectiveController;
use Azuriom\Plugin\Gamify\Models\Objective;
use Azuriom\Plugin\Gamify\Models\UserObjective;
use Azuriom\Plugin\Gamify\Services\ObjectiveService;

require __DIR__.'/vendor/autoload.php';

// Mock the ObjectiveService
class MockObjectiveService extends ObjectiveService {
    public function __construct() {
        // Empty constructor to avoid dependency issues
    }

    public function calculateProgress(\Azuriom\Models\User $user, \Azuriom\Plugin\Gamify\Models\Objective $objective): int {
        return 50; // Return a fixed progress value for testing
    }
}

// Create an instance of the controller with our mock service
$objectiveController = new class(new MockObjectiveService()) extends ObjectiveController {
    // Make the private method accessible for testing
    public function testDetermineObjectiveStatus($progress, $requiredAmount) {
        return $this->determineObjectiveStatus($progress, $requiredAmount);
    }
};

// Test different scenarios
$tests = [
    ['progress' => 0, 'required' => 100, 'expected' => UserObjective::STATUS_NOT_STARTED_INT],
    ['progress' => 50, 'required' => 100, 'expected' => UserObjective::STATUS_IN_PROGRESS_INT],
    ['progress' => 100, 'required' => 100, 'expected' => UserObjective::STATUS_COMPLETED_INT],
    ['progress' => 150, 'required' => 100, 'expected' => UserObjective::STATUS_COMPLETED_INT],
];

$allPassed = true;
foreach ($tests as $index => $test) {
    $result = $objectiveController->testDetermineObjectiveStatus($test['progress'], $test['required']);
    $status = is_int($result) ? 'integer' : gettype($result);
    $passed = $result === $test['expected'];

    echo "Test #" . ($index + 1) . ": ";
    echo "Progress = {$test['progress']}, Required = {$test['required']}\n";
    echo "Expected: {$test['expected']} (int), Got: {$result} ({$status})\n";
    echo "Result: " . ($passed ? "PASSED" : "FAILED") . "\n\n";

    if (!$passed) {
        $allPassed = false;
    }
}

echo $allPassed ? "All tests PASSED! The fix is working correctly." : "Some tests FAILED! The fix needs adjustment.";
