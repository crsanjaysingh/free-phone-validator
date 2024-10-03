@extends('layouts/user/contentNavbarLayout')

@section('title', 'Recent Lookup')

@section('page-script')
@endsection

@section('content')

<!-- Breadcrumb Component -->
@php
$breadcrumbs = [
  ['label' => 'Dashboard', 'url' => route('user.dashboard'), 'active' => false],
  ['label' => 'Phone Lookup API', 'url' => '', 'active' => true]
];
@endphp
@include('components.user.breadcrumb', ['title' => 'Dashboard', 'breadcrumbs' => $breadcrumbs, 'styleClass' => 'breadcrumb-style1', 'cardHeader'=>false, 'cardHeaderHeading'=>"Edit Plan"])
<!-- Breadcrumb Component -->
<div class="mb-6 card">
  <div class="card-body">
    <div class="row">
      <!-- Custom content with heading -->
      <div class="mb-6 col-lg-6 mb-xl-0">
        <h6 class="card-header">How to Use API</h6>
      </div>
      <div class="col-lg-6">
        <h5 class="card-header">Example Code</h5>
        <div class="mt-4 demo-inline-spacing">
          <div class="list-group list-group-horizontal-md text-md-center">
            <a class="list-group-item list-group-item-action active" id="home-list-item" data-bs-toggle="list" href="#horizontal-home">PHP</a>
            <a class="list-group-item list-group-item-action" id="profile-list-item" data-bs-toggle="list" href="#horizontal-profile">Node Js</a>
            <a class="list-group-item list-group-item-action" id="messages-list-item" data-bs-toggle="list" href="#horizontal-messages">Python</a>
          </div>
          <div class="px-0 pt-1 mt-0 tab-content">
            <div class="tab-pane fade show active" id="horizontal-home">
              <pre><code class="language-php">
// Your API Key.
$key = '<?=$data['access_token']?>';

/*
* User's phone.
*/
$phone = '18007132618';

// Retrieve additional (optional) data points which help us enhance fraud scores and ensure data is processed correctly.
$countries = array('US', 'CA');

// Create parameters array.
$parameters = array(
  'country' => $countries
);

/* User & Transaction Scoring
* Score additional information from a user, order, or transaction for risk analysis
* Please see the documentation and example code to include this feature in your scoring:
* https://www.ipqualityscore.com/documentation/phone-number-validation-api/transaction-scoring
* This feature requires a Premium plan or greater
*/

// Format Parameters
$formatted_parameters = http_build_query($parameters);

// Create API URL
$url = sprintf(
  'https://www.ipqualityscore.com/api/json/phone/%s/%s?%s',
  $key,
  $phone,
  $formatted_parameters
);

// Fetch The Result
$timeout = 5;

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);

$json = curl_exec($curl);
curl_close($curl);

// Decode the result into an array.
$result = json_decode($json, true);

// Check to see if our query was successful.
if(isset($result['success']) && $result['success'] === true){
  // NOTICE: If you want to use one of the examples below, remove
  // any lines containing /*, */ and *-, then remove * from any of the
  // the remaining lines.

  /*
  *- Example 1: We'd like to block all invalid phone numbers and send them to Google.
  *
  * if($result['valid'] === false || $result['active'] === false){
  *		exit(header("Location: https://google.com"));
  * }
  */

  /*
  *- Example 2: We'd like to block all invalid or abusive phone numbers.
  *
  * if($result['valid'] === false || $result['fraud_score'] >= 90){
  *		exit(header("Location: https://google.com"));
  * }
  */

  /*
  * If you are confused with these examples or simply have a use case
  * not covered here, please feel free to contact IPQualityScore's support
  * team. We'll craft a custom piece of code to meet your requirements.
  */
}

                </code></pre>

                <button class="copy-button">Copy</button>
            </div>
            <div class="tab-pane fade" id="horizontal-profile">
              Muffin lemon drops chocolate chupa chups jelly beans dessert jelly-o. Soufflé gummies gummies. Ice cream
              powder marshmallow cotton candy oat cake wafer. Marshmallow gingerbread tootsie roll. Chocolate cake bonbon
              jelly beans lollipop jelly beans halvah marzipan danish pie. Oat cake chocolate cake pudding bear claw
              liquorice gingerbread icing sugar plum brownie. Toffee cookie apple pie cheesecake bear claw sugar plum
              wafer gummi bears fruitcake.
            </div>
            <div class="tab-pane fade" id="horizontal-messages">
              Ice cream dessert candy sugar plum croissant cupcake tart pie apple pie. Pastry chocolate chupa chups
              tiramisu. Tiramisu cookie oat cake. Pudding brownie bonbon. Pie carrot cake chocolate macaroon. Halvah jelly
              jelly beans cake macaroon jelly-o. Danish pastry dessert gingerbread powder halvah. Muffin bonbon fruitcake
              dragée sweet sesame snaps oat cake marshmallow cheesecake. Cupcake donut sweet bonbon cheesecake soufflé
              chocolate bar.
            </div>
          </div>
        </div>
      </div>
      <!--/ Custom content with heading -->
    </div>
  </div>
</div>
@endsection
@push("styles")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/default.min.css">
<style>
  /* Code block styles */
  pre {
      position: relative;
      background-color: #2d2d2d;
      color: #f8f8f2;
      padding: 3px;
      border-radius: 10px;
      font-family: monospace;
  }

  /* Copy button styling */
  .copy-btn {
      position: absolute;
      top: 10px;
      right: 10px;
      background-color: #ff6b6b;
      color: white;
      border: none;
      padding: 5px 10px;
      border-radius: 5px;
      cursor: pointer;
  }

  .copy-btn:hover {
      background-color: #ff4757;
  }
</style>

@endpush
@push("scripts")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.10/clipboard.min.js"></script>
    <script>
      hljs.initHighlightingOnLoad();

      var clipboard = new Clipboard('.copy-button');

      clipboard.on('success', function(e) {
          console.log(e);
      });

      clipboard.on('error', function(e) {
          console.error('Action  failed: ', e);
      });
  </script>
@endpush


