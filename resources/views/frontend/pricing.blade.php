@extends('layouts/frontend/app')

@section('frontendContent')
    <!-- ======== Pricing start ======== -->
    <section id="pricing-section" class="mt-100 pricing-section">
        <div class="container">
            <div class="row justify-content-center">
              <main>
                  <div class="auto">
                    <div class="p-3 mx-auto mt-5 mb-5 text-center pricing-header pb-md-4">
                      <h1 class="display-4 fw-normal">Pricing</h1>
                      <p class="fs-5 text-muted">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It’s built with default Bootstrap components and utilities with little customization.</p>
                    </div>
                    <div class="mb-3 text-center row row-cols-1 row-cols-md-3">
                      @foreach($plans as $plan)
                          <div class="col">
                              <div class="mb-4 shadow-sm card rounded-3 @if($plan['plan_type'] === 'enterprise') border-primary @endif">
                                  <div class="py-3 @if($plan['plan_type'] === 'enterprise') text-white card-header bg-primary border-primary @else card-header @endif">
                                      <h4 class="my-0 fw-normal">{{ $plan['name'] }}</h4>
                                  </div>
                                  <div class="card-body">
                                      <h1 class="card-title pricing-card-title">${{ $plan['plan_cost'] }}<small class="text-muted fw-light">/mo</small></h1>
                                      <ul class="mt-3 mb-4 list-unstyled">
                                        <li>Lookups Limit {{ $plan['lookup_limit'] }}/Month</li>
                                          @foreach($plan['features'] as $feature)
                                              <li>{{ $feature }}</li>
                                          @endforeach
                                      </ul>
                                      @php
                                          $userPlan = auth()->user()->subscription->plan_id ?? null;
                                      @endphp
                                      @if($userPlan == $plan['id'])
                                      <!-- Active Plan Button -->
                                          <button class="w-100 btn btn-lg btn-success" disabled>
                                              Active Plan
                                          </button>

                                      @elseif($userPlan && $plan['id'] > $userPlan)
                                          <!-- Upgrade Plan Button -->
                                          <button data-action="upgrade" data-url="{{ route('user.update.subscription') }}" data-plan-id="{{ $plan['id'] }}" class="w-100 btn btn-lg btn-warning">
                                              Upgrade Plan
                                          </button>

                                      @elseif($userPlan && $plan['id'] < $userPlan)
                                          <!-- Downgrade Plan Button -->
                                          <button data-action="downgrade" data-url="{{ route('user.update.subscription') }}" data-plan-id="{{ $plan['id'] }}" class="w-100 btn btn-lg btn-secondary">
                                              Downgrade Plan
                                          </button>

                                      @else
                                          <!-- Subscribe Button (if no active plan or plan is free) -->
                                          <button data-action="subscribe" data-url="{{ route('user.subscribe') }}" data-plan-id="{{ $plan['id'] }}" class="w-100 btn btn-lg {{ $plan['is_free'] ? 'btn-outline-primary' : 'btn-primary' }}">
                                              {{ $plan['is_free'] ? 'Sign up for free' : 'Get started' }}
                                          </button>
                                      @endif
                                  </div>
                              </div>
                          </div>
                      @endforeach
                    </div>
                  </div>
              </main>
            </div>
        </div>

        <!-- Confirmation Modal -->
        <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirm Action</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                Are you sure you want to <span id="modalAction"></span> this plan?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmAction">Yes, Proceed</button>
              </div>
            </div>
          </div>
        </div>

    </section>
    <!-- ======== Pricing end ======== -->
@endsection
@push('styles')
    @vite('resources/assets/frontend/css/home-page.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush

@push('scripts')
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @vite('resources/assets/frontend/js/subscription-page.js')
@endpush
