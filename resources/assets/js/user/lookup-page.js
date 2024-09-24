$(document).ready(function () {
  $('#lookupTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: lookupRoute,
    columns: [
      { data: 'id', name: 'id' },
      { data: 'lookup_type', name: 'lookup_type' },
      { data: 'lookup_for', name: 'lookup_for' },
      { data: 'fraud_score', name: 'fraud_score' },
      { data: 'status', name: 'status' },
      { data: 'country', name: 'country' },
      { data: 'user', name: 'user' },
      { data: 'created_at', name: 'created_at', orderable: false, searchable: false },
    ],
    order: [[0, 'desc']],
    language: {
      emptyTable: "No data found"
    }
  });
});
