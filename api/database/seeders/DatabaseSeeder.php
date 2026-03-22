<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Event;
use App\Models\Attendee;
use App\Models\Ticket;
use App\Models\Payment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Ensure the admin exists and assign it to $admin
        $admin = User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'admin',
                'password' => bcrypt('admin'),
                'role' => 'admin',
            ]
        );

        // Create 5 Events
        Event::factory(10)->create()->each(function ($event) use ($admin) {

            // Create 10 Attendees for this specific event
            Attendee::factory(10)->create([
                'event_id' => $event->id,
            ]);

            // Create 5 Tickets assigned to your Admin
            Ticket::factory(5)->create([
                'event_id' => $event->id,
                'user_id' => $admin->id, // Now $admin is guaranteed to have an ID
            ])->each(function ($ticket) {

                //  Create a successful Payment record
                Payment::factory()->create([
                    'ticket_id' => $ticket->id,
                    'payment_status' => 'paid',
                    'payment_method' => 'stripe',
                    'amount' => $ticket->price,
                ]);
            });
        });

        $this->command->info("Data seeded successfully! Events, Attendees, Tickets, and Payments are ready.");
    }
}
