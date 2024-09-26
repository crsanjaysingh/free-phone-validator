
  @if(!@empty($subscription))
  <div class="card " style="max-width: 600px; margin:auto">
    <!-- Plan Info -->
    <div class="mt-5 mb-3 row">
      <div class="col-md-6 text-md-end">
        <h6>Plan Name:</h6>
        <p class="mb-0"><strong>{{ $subscription->plan->name }}</strong></p>
      </div>
      <div class="col-md-6 text-md-start">
        <h6>Cost:</h6>
        <p class="mb-0 text-success"><strong>${{ $subscription->plan->plan_cost }} / {{ $subscription->plan->plan_type }}</strong></p>
      </div>
    </div>

    <!-- Subscription Dates -->
    <div class="mb-3 row">
      <div class="col-md-6 text-md-end">
        <h6>Subscription Start:</h6>
        <p class="mb-0"><strong>{{ $subscription->plan->started_at }}</strong></p>
      </div>
      <div class="col-md-6 text-md-start">
        <h6>Next Billing Date:</h6>
        <p class="mb-0"><strong>{{ $subscription->plan->ends_at }}</strong></p>
      </div>
    </div>

    <!-- Payment Info -->
    <div class="mb-3 row">
      <div class="col-md-6 text-md-end">
        <h6>Payment Method:</h6>
        <p class="mb-0"><strong>Wallet</strong></p>
      </div>
      <div class="col-md-6 text-md-start">
        <h6>Last Payment:</h6>
        <p class="mb-0 text-success"><strong>January 12, 2024</strong></p>
      </div>
    </div>

    <!-- Payment Status -->
    <div class="mb-3 row">
      <div class="col-md-6 text-md-end">
        <h6>Current Status:</h6>
        @if($subscription->status==1)
          <span class="badge bg-success">Active</span>
        @elseif($subscription->status==2)
          <span class="badge bg-danger">Paused</span>
        @elseif($subscription->status==3)
           <span class="badge bg-danger">Cancelled</span>
        @else
            <span class="badge bg-danger">Expired</span>
        @endif
      </div>
      <div class="col-md-6 text-md-start">
        <h6>Auto-renewal:</h6>
        @if($subscription->status==2)
          <span class="badge bg-danger">Disabled</span>
        @else
          <span class="badge bg-info">Enabled</span>
        @endif
      </div>
    </div>

    <!-- Actions -->
    <div class="mt-4 mb-5 row">
      <div class="text-center col">
        <input type="hidden" id="planStatusROute" value="{{ route("user.plan.status") }}">
        @if($subscription->status==1)
          <button class="btn btn-warning pause-subscription" data-id="{{  $subscription->id }}">Pause Subscription</button>
          <button class="btn btn-danger cancel-subscription" data-id="{{  $subscription->id }}">Cancel Subscription</button>
        @elseif($subscription->status==2)
          <button class="btn btn-success continue-subscription" data-id="{{  $subscription->id }}">Continue Subscription</button>
          <button class="btn btn-danger cancel-subscription" data-id="{{  $subscription->id }}">Cancel Subscription</button>
        @else
          <a href="{{ route("pricing") }}" class="btn btn-success cancel-subscription">No plan found, Please checkout plans here</a>
        @endif
      </div>
    </div>
 </div>
  @endif
