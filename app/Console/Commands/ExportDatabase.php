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
        $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $host = $url["host"] ?? null;
        $username = $url["user"] ?? null;
        $password = $url["pass"] ?? null;
        $database = substr($url["path"], 1);

        $process = Process::fromShellCommandline(sprintf(
            'mysqldump -u%s -p%s %s > %s',
            $username,
            $password,
            $database,
            storage_path('app/database.sql')
        ));

        $process->run();
        $this->info($process->getOutput());
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $this->info('Database exported successfully!');
    }
}
