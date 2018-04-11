<?php

use App\Quote;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use League\Csv\Reader;
use League\Csv\Statement;

class QuotesSeeder extends Seeder
{
    public function run(): void
    {
        $reader = Reader::createFromPath('./database/quotes.csv');
        $reader->setHeaderOffset(0);
        $records = (new Statement())->process($reader);

        foreach ($records as $record) {
            Quote::create([
                'body' => array_get($record, 'body'),
                'created_at' => $this->createdAtIsNowIfIncorrect(array_get($record, 'created_at')),
                'deleted_at' => $this->deleteIfLowPoints(array_get($record, 'points'))
            ]);
        }
    }

    private function createdAtIsNowIfIncorrect(string $createdAt): string
    {
        return $createdAt === '0000-00-00 00:00:00'
            ? Carbon::now()->format('Y-m-d h:i:s')
            : $createdAt;
    }

    private function deleteIfLowPoints(string $points): ?string
    {
        if ((int) $points < 0) {
            return Carbon::now()->format('Y-m-d h:i:s');
        }

        return null;
    }
}
