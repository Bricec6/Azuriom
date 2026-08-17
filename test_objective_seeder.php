<?php

// Test script to verify the ObjectiveSeeder works correctly
// This script tests that the seeder creates objectives for all hook-trigger combinations

require_once 'bootstrap/app.php';

use Azuriom\Plugin\Gamify\Models\Objective;
use Azuriom\Plugin\Gamify\Database\Seeders\ObjectiveSeeder;
use Azuriom\Plugin\Gamify\Services\HookService;

echo "Testing ObjectiveSeeder\n";
echo "======================\n\n";

// Get initial count of objectives
$initialCount = Objective::count();
echo "Initial objectives count: $initialCount\n";

// Get all hooks and triggers from HookService
$hookService = app(HookService::class);
$hooks = $hookService->getHooks();

$expectedCount = 0;
foreach ($hooks as $hook => $triggers) {
    $expectedCount += count($triggers) * 3; // 3 objectives per trigger
}

echo "Expected objectives to be created: $expectedCount\n";
echo "Hooks found: " . count($hooks) . "\n";
echo "Total triggers: " . array_sum(array_map('count', $hooks)) . "\n\n";

// List all hooks and triggers
echo "Hook-Trigger combinations:\n";
foreach ($hooks as $hook => $triggers) {
    echo "- {$hook}: " . implode(', ', array_keys($triggers)) . "\n";
}
echo "\n";

try {
    // Run the seeder
    echo "Running ObjectiveSeeder...\n";
    $seeder = new ObjectiveSeeder();
    $seeder->run();

    // Check results
    $finalCount = Objective::count();
    $createdCount = $finalCount - $initialCount;

    echo "✓ Seeder completed successfully!\n";
    echo "Objectives created: $createdCount\n";
    echo "Final objectives count: $finalCount\n\n";

    if ($createdCount === $expectedCount) {
        echo "✅ SUCCESS: Correct number of objectives created!\n";
    } else {
        echo "⚠ WARNING: Expected $expectedCount but created $createdCount objectives\n";
    }

    // Sample some created objectives
    echo "\nSample created objectives:\n";
    $sampleObjectives = Objective::orderBy('created_at', 'desc')->take(5)->get();

    foreach ($sampleObjectives as $objective) {
        echo "- {$objective->name} ({$objective->hook}:{$objective->trigger}) - Amount: {$objective->amount}\n";
        echo "  Description: " . substr($objective->description, 0, 60) . "...\n";
        echo "  Rewards: " . json_encode($objective->rewards) . "\n";
        echo "  Enabled: " . ($objective->is_enabled ? 'Yes' : 'No') . "\n\n";
    }

} catch (Exception $e) {
    echo "❌ ERROR: Seeder failed with message: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}

echo "Test completed!\n";
