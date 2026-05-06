<?php

namespace App\Console\Commands;

use App\Models\News;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

#[Signature('app:get-news')]
#[Description('Fetch latest news from CurrentsAPI and store in database')]
class GetNews extends Command
{
    /**
     * The API endpoint URL.
     */
    protected string $apiUrl = 'https://api.currentsapi.services/v1/latest-news';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $apiKey = env('CURRENTS_API_KEY');

        if (empty($apiKey)) {
            $this->error('CURRENTS_API_KEY is not set in .env file');
            Log::error('CURRENTS_API_KEY is not set in .env file');
            return;
        }

        $this->info('Fetching news from CurrentsAPI...');

        try {
            $response = Http::withHeaders([
                'Authorization' => $apiKey,
                'Accept' => 'application/json',
            ])->get($this->apiUrl);

            if (!$response->successful()) {
                $this->error('Failed to fetch news. Status: ' . $response->status());
                Log::error('CurrentsAPI request failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                return;
            }

            $data = $response->json();

            if (!isset($data['news']) || !is_array($data['news'])) {
                $this->error('Invalid API response format');
                Log::error('Invalid CurrentsAPI response format', ['data' => $data]);
                return;
            }

            $newsItems = $data['news'];

            // Filter valid items
            $validItems = array_filter($newsItems, function ($item) {
                return isset($item['id'], $item['title']);
            });

            if (empty($validItems)) {
                $this->info('No valid news items found.');
                return;
            }

            // Get all existing UUIDs in one query
            $existingUuids = News::whereIn('uuid', array_column($validItems, 'id'))
                ->pluck('uuid')
                ->toArray();

            // Filter out items that already exist
            $newItems = array_filter($validItems, function ($item) use ($existingUuids) {
                return !in_array($item['id'], $existingUuids);
            });

            if (empty($newItems)) {
                $this->info('All news items already exist in database.');
                return;
            }

            // Prepare data for batch insert
            $insertData = [];
            $now = now();

            foreach ($newItems as $item) {
                $publishedAt = $item['published']
                    ? \DateTime::createFromFormat('Y-m-d H:i:s T', $item['published'])->format('Y-m-d H:i:s')
                    : null;
                $insertData[] = [
                    'uuid' => $item['id'],
                    'title' => $item['title'],
                    'published_at' => $publishedAt,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            // Batch insert
            News::insert($insertData);

            $savedCount = count($insertData);
            $skippedCount = count($validItems) - $savedCount;

            $this->info("Successfully saved {$savedCount} new news items. Skipped {$skippedCount} existing items.");
            Log::info('GetNews command executed', [
                'saved' => $savedCount,
                'skipped' => $skippedCount,
                'total' => count($newsItems),
            ]);
        } catch (\Exception $e) {
            $this->error('Error fetching news: ' . $e->getMessage());
            Log::error('GetNews command failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }
}
