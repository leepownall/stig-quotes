<?php

use App\Quote;
use Illuminate\Database\Seeder;
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
            Quote::create($record);
        }
    }
}
