<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class InvoicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Invoice::class, 2)->create();

        factory(App\Invoice::class)->create([
            'issue_date' => Carbon::now()->subYear()->subHour(),
            'due_date' => Carbon::now()->subYear()->addWeeks(2),
            'is_paid' => '1',
            'paid_at' => Carbon::now()->subYear(),
        ]);
    }
}
