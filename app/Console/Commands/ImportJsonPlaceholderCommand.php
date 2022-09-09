<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Components\ImportDataClient;
use App\Models\Post;
use PhpParser\JsonDecoder;

class ImportJsonPlaceholderCommand extends Command
{

    protected $signature = 'import:jsonplaceholder';

    protected $description = 'Get data from jsonplaceholder | AUTOSELLER';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $import = new ImportDataClient();
        $response = $import->client->request('GET', 'posts');
        $data = json_decode($response->getBody()->getContents());

        foreach ($data as $item) {
            Post::firstOrCreate([
                'title' => $item->title
            ],[
                'title' => $item->title,
                'content' => $item->body,
                'category_id' => 2,
            ]);
        }
        dd('finish');
    }
}
