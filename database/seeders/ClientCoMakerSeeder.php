<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DBLoans\CoMaker;
use Illuminate\Support\Facades\DB;
class ClientCoMakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coMakers = CoMaker::get(['client_id','id']);
        $collection = collect($coMakers)->map(function($item){ $item['co_maker_id'] = $item['id']; unset($item['id']); return $item; })->toArray();
        DB::table('client_co_makers')->upsert($collection,['client_id','co_maker_id']);
    }
}
