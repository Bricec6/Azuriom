<?php

// Simple test script to verify the Gamify plugin fix
// This script tests that user_objectives are only created when rewards are claimed

require_once 'bootstrap/app.php';

use Azuriom\Models\User;
use Azuriom\Plugin\Gamify\Models\Objective;
use Azuriom\Plugin\Gamify\Models\UserObjective;
use Azuriom\Plugin\Gamify\Services\ObjectiveService;

echo "Testing Gamify Plugin Fix\n";
echo "========================\n\n";

// Test 1: Check that calculateProgress doesn't create database records
echo "Test 1: Verify calculateProgress doesn't create UserObjective records\n";

// Count existing UserObjective records
$initialCount = UserObjective::count();
echo "Initial UserObjective count: $initialCount\n";

// Get a test user and objective
$user = User::first();
$objective = Objective::first();

if ($user && $objective) {
    $objectiveService = new ObjectiveService();

    // Calculate progress - this should NOT create a database record
    $progress = $objectiveService->calculateProgress($user, $objective);
    echo "Calculated progress for user {$user->id} on objective {$objective->id}: $progress\n";

    // Check count after calculation
    $afterCalculationCount = UserObjective::count();
    echo "UserObjective count after calculation: $afterCalculationCount\n";

    if ($initialCount === $afterCalculationCount) {
        echo "✓ PASS: No database records created during progress calculation\n";
    } else {
        echo "✗ FAIL: Database records were created during progress calculation\n";
    }
} else {
    echo "⚠ SKIP: No user or objective found for testing\n";
}

echo "\n";

// Test 2: Verify that only claimed objectives exist in database
echo "Test 2: Verify only claimed objectives exist in UserObjective table\n";

$allUserObjectives = UserObjective::all();
$claimedCount = $allUserObjectives->where('status', UserObjective::STATUS_CLAIMED)->count();
$totalCount = $allUserObjectives->count();

echo "Total UserObjective records: $totalCount\n";
echo "Claimed UserObjective records: $claimedCount\n";

if ($claimedCount === $totalCount) {
    echo "✓ PASS: All UserObjective records are claimed\n";
} else {
    echo "✗ FAIL: Found non-claimed UserObjective records in database\n";
    echo "This indicates the old system created records that should be cleaned up\n";
}

echo "\nTest completed!\n";
