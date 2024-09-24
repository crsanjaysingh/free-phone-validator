$(document).ready(function () {
  var ajaxUrl = $('#plansTable').data('url');

  $('#plansTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: ajaxUrl,
      type: 'GET'
    },
    columns: [
      { data: 'id', name: 'id' },
      { data: 'name', name: 'name' },
      {
        data: 'plan_tags',
        name: 'plan_tags',
        render: function (data, type, row) {
          return (data == '' || data == null) ? '<span class="badge rounded-pill bg-dark">N/A</span>' : '<span class="badge rounded-pill bg-dark">' + data + '</span>';
        }
      },
      {
        data: 'is_free',
        name: 'is_free',
        render: function (data, type, row) {
          return data == 1 ? '<span class="badge rounded-pill bg-success">Yes</span>' : '<span class="badge rounded-pill bg-danger">No</span>';
        }
      },
      { data: 'plan_cost', name: 'plan_cost' },
      { data: 'plan_type', name: 'plan_type' },
      {
        data: 'status',
        name: 'status',
        render: function (data, type, row) {
          return data == "Active" ? '<span class="badge rounded-pill bg-success">Active</span>' : '<span class="badge rounded-pill bg-danger">Inactive</span>';
        }
      },
      { data: 'action', name: 'action', orderable: false, searchable: false }
    ]
  });
});
