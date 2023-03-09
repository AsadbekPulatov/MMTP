<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Telegram\Bot\Api;
use Telegram\Bot\FileUpload\InputFile;

class SendDatabase extends Command
{
    protected $signature = 'database:send';

    public function handle()
    {
        $telegram = new Api(env('TELEGRAM_BOT_TOKEN'));

        $telegram->sendDocument([
            'chat_id' => env('TELEGRAM_CHAT_ID'),
            'document' => storage_path('app\database.sql'),
        ]);

        $this->info('Database sent to Telegram successfully!');
    }
}
