<?php

require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$users = App\Models\User::all();

foreach($users as $user) {
    echo "User: {$user->name} - Photo: {$user->photo_path}" . PHP_EOL;
    if ($user->photo_path) {
        $fullPath = storage_path("app/public/{$user->photo_path}");
        echo "  File exists: " . (file_exists($fullPath) ? 'YES' : 'NO') . PHP_EOL;
        echo "  Full path: {$fullPath}" . PHP_EOL;
    }
    echo "---" . PHP_EOL;
}
