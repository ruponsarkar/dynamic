@extends('adminpanel/layout')

@section('title', 'All Manuscript')
@section('breadcrumb', 'All Manuscript')
@section('content')

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title text-center">All Manuscript</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body" style="overflow-x: auto">
            <table id="tableManu" class="table table-bordered table-hover small table-responsive">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Unique ID </th>
                  <th>File</th>
                  <th>Mode</th>
                  <th>Author</th>
                  <th>email & Mobile</th>
                  {{-- <th>Orcid-id</th> --}}
                  <th>Journal</th>
                  <th>Manuscript</th>
                  <th>Type</th>
                  <th>Affiliation</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($manuscript as $key=>$data)
                <tr class="manuscript-row" data-id="{{$data->m_id}}" data-status="{{$data->status}}" data-muuid="{{$data->muuid}}">
                  <td>{{$key+1}}</td>
                  <td>{{$data->muuid}}</td>
                  <td><a href="viewer/{{$data->m_id}}"> {{$data->file}} </a></td>
                  <td>{{$data->mode}}</td>
                  <td>{{$data->author}}</td>
                  <td>{{$data->email}}<br>{{$data->mobile}}</td>
                  {{-- <td>{{$data->orcid_id}}</td> --}}
                  <td>{{$data->journal}}</td>
                  <td>{{$data->manuscript}}</td>
                  <td>{{$data->type}}</td>
                  <td>{{$data->affiliation}}</td>
                  <td>{{ $data->date }}</td>

                  <td>
                    @if ($data->status === 0)
                    <span class="btn btn-sm btn-success">Initial stage</span>
                    @elseif ($data->status === 1)
                    <span class="btn btn-sm btn-warning">Review</span>
                    @elseif ($data->status === 2)
                    <span class="btn btn-sm btn-primary">Awaiting Editorial Approval</span>
                    @elseif ($data->status === 3)
                    <span class="btn btn-sm btn-danger">Re-review</span>
                    @elseif ($data->status === 4)
                    <span class="btn btn-sm btn-danger">Final Verification of Content</span>
                    @elseif ($data->status === 5)
                    <span class="btn btn-sm btn-danger">Published</span>
                    @else
                    <span class="btn btn-sm btn-danger">Rejected</span>
                    @endif
                  </td>
                  <td class="text-center">
                    <button type="button" class="btn btn-success btn-sm update-status-btn" data-bs-toggle="modal" data-bs-target="#updateStatusModal">
                      Update Status
                    </button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>

<!-- Modal -->
<div class="modal fade" id="updateStatusModal" aria-hidden="true" aria-labelledby="updateStatusModalLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="updateStatusModalLabel">Update Manuscript</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <form id="updateStatusForm">
          @csrf
          <input type="hidden" name="status" id="selectedStatus">
          <input type="hidden" name="mid" id="mid" value="12345">
          <select class="form-select" aria-label="Default select example" id="statusSelect" required>
            <option selected disabled>Select status</option>
            <option value="0">Initial stage</option>
            <option value="1">Review</option>
            <option value="2">Awaiting Editorial Approval</option>
            <option value="3">Re-review</option>
            <option value="4">Final Verification of Content</option>
            <option value="5">Published</option>
            <option value="6">Reject</option>
          </select>
          <button type="button" class="btn btn-primary mt-3" onclick="submitForm()">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  let selectedRow, status, selectedRowID;
  document.getElementById('tableManu').addEventListener('click', function(event) {
    if (event.target && event.target.classList.contains('update-status-btn')) {
      const row = event.target.closest('.manuscript-row');
      selectedRow = row.getAttribute('data-muuid');
      selectedRowID = row.getAttribute('data-id');
    }
  });
  async function submitForm() {
    // console.log('ID:', selectedRow);
    document.querySelectorAll('.update-status-btn').forEach(button => {
      button.addEventListener('click', function() {});
    });
    const selectedStatus = document.getElementById('statusSelect').value;
    const mid = document.getElementById('mid').value;

    const response = await fetch('/api/update-status', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
      },
      body: JSON.stringify({
        selectedID: selectedRow,
        selectedStatus: selectedStatus,
        selectedRowID: selectedRowID
      })
    });

    const result = await response.json();

    if (response.ok) {
      // alert(result.message,'dashduisab');
      location.reload();
    } else {
      alert('Failed to update status: ' + result.message);
    }
  }
</script>



@endsection