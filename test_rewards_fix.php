<?php

require __DIR__.'/vendor/autoload.php';

use Azuriom\Models\User;
use Azuriom\Plugin\Gamify\Models\Objective;
use Azuriom\Plugin\Gamify\Services\ObjectiveService;

// This script will test if the rewards system is working properly
// 1. Create a mock reward with command that has server_id
// 2. Execute the reward and check the logs

$userId = 1; // Assuming user #1 exists (typically the admin)
$user = User::find($userId);

if (!$user) {
    die("Test user not found. Please create a user with ID $userId first.\n");
}

// Find a valid server ID to use for testing
$serverCount = app('servers')->count();
if ($serverCount === 0) {
    die("No servers found. Please add a server in the admin panel first.\n");
}

$serverId = app('servers')->first()->id;
echo "Using server ID: {$serverId}\n";

// Create a test objective with all reward types
$testRewards = [
    [
        'type' => 'money',
        'value' => '100'
    ],
    [
        'type' => 'command',
        'name' => 'Test Command',
        'value' => 'give {name} diamond 1',
        'server_id' => $serverId
    ],
    [
        'type' => 'trophy',
        'value' => '100'
    ]
];

$objective = new Objective([
    'name' => 'Test Rewards',
    'hook' => 'azuriom',
    'trigger' => 'login',
    'amount' => 1,
    'description' => 'Test objective for rewards',
    'rewards' => $testRewards,
    'is_enabled' => true
]);

// Get the ObjectiveService
$objectiveService = app(ObjectiveService::class);

// Execute rewards directly
echo "Testing reward execution...\n";

// Check user's initial values
$initialMoney = $user->money;
$initialTrophyPoints = $user->trophy_points;

// Execute rewards
try {
    echo "Initial money: {$initialMoney}\n";
    echo "Initial trophy points: {$initialTrophyPoints}\n";

    $objectiveService->giveRewards($user, $objective);

    // Refresh user from database
    $user->refresh();

    echo "After money: {$user->money}\n";
    echo "After trophy points: {$user->trophy_points}\n";

    // Check money reward
    if ($user->money === ($initialMoney + 100)) {
        echo "✅ Money reward successful\n";
    } else {
        echo "❌ Money reward failed\n";
    }

    // Check trophy reward
    if ($user->trophy_points === ($initialTrophyPoints + 100)) {
        echo "✅ Trophy reward successful\n";
    } else {
        echo "❌ Trophy reward failed\n";
    }

    // For command, we can only check logs
    echo "✅ Command execution should be logged in laravel log\n";
    echo "Please check storage/logs/laravel-".date('Y-m-d').".log for command execution logs\n";

} catch (\Exception $e) {
    echo "Error executing rewards: {$e->getMessage()}\n";
    echo $e->getTraceAsString();
}

echo "\nTest complete. Check the logs for command execution details.\n";
