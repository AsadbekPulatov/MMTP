<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;



class ExportDatabase extends Command
{

    protected $signature = 'database:export';

    public function handle()
    {
        $host = env('DB_HOST');
        $port = env('DB_PORT');
        $database = env('DB_DATABASE');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');

//        dd($host, $port, $database, $username, $password);
        // Set the export file name and path
        $filename = 'database.sql';
        $filepath = storage_path("app" . $filename);

        // Execute the mysqldump command to export the database
        $command = "mysqldump -h{$host} -u{$username} -p{$password} {$database} > {$filepath}";
        exec($command);

        // Display a message to indicate that the export has been completed
        $this->info("The database has been exported and saved to {$filepath}");
    }
}
