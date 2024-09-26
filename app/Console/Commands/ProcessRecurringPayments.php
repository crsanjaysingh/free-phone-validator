<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Subscription;
use App\Models\User;
use App\Notifications\InsufficientFundsNotification;

class ProcessRecurringPayments extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'subscriptions:autorenew';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Process recurring payments for user subscriptions from wallet';

  /**
   * Execute the console command.
   */
  public function handle()
  {
    $today = Carbon::now();

    // Find subscriptions that are due for payment today
    $subscriptions = Subscription::where('is_recurring', true)
      ->where('next_billing_date', '<=', $today)
      ->where('active', true)
      ->get();

    foreach ($subscriptions as $subscription) {
      $user = $subscription->user;
      $plan = $subscription->plan;

      // Check if the user has enough wallet balance for the subscription
      if ($user->wallet_balance >= $plan->plan_cost) {
        // Deduct the plan cost from the user's wallet
        $user->wallet_balance -= $plan->plan_cost;
        $user->save();

        // Update the next billing date for the subscription
        $subscription->next_billing_date = Carbon::now()->addMonth();
        $subscription->save();

        $this->info('Subscription renewed for user: ' . $user->email);
      } else {

        $user->notify(new InsufficientFundsNotification($plan));
        $subscription->update(['active' => false]);
        $this->info('Insufficient funds for user: ' . $user->email . ' (Subscription paused)');
      }
    }

    return Command::SUCCESS;
  }
}
