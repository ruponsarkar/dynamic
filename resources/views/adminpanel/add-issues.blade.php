@extends('adminpanel/layout')
@section('title', 'Dashboard')
@section('meta')

    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')

    <style>
        .issues-page {
            padding: 8px 0 24px;
        }

        .issues-panel {
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            box-shadow: 0 16px 40px rgba(15, 23, 42, 0.06);
            overflow: hidden;
        }

        .issues-panel .card-header {
            padding: 20px 24px;
            border-bottom: 1px solid #eef2f7;
            background: linear-gradient(135deg, #f8fafc 0%, #eef6ff 100%);
        }

        .issues-title {
            margin: 0;
            font-size: 1.4rem;
            font-weight: 700;
            color: #172554;
        }

        .issues-subtitle {
            margin: 6px 0 0;
            color: #64748b;
            font-size: 0.95rem;
        }

        .issue-form-card {
            background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
        }

        .issue-form-body {
            padding: 24px;
        }

        .issue-form-body .form-label {
            font-weight: 600;
            color: #334155;
        }

        .issue-form-body .form-control {
            min-height: 46px;
            border-radius: 12px;
            border-color: #dbe3ee;
        }

        .issue-form-body .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.12);
        }

        .issue-list-body {
            padding: 0;
        }

        .issues-table-wrap {
            overflow-x: auto;
        }

        .issues-table {
            margin-bottom: 0;
        }

        .issues-table thead th {
            white-space: nowrap;
            background: #f8fafc;
            color: #475569;
            font-size: 0.82rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            border-bottom-width: 1px;
        }

        .issues-table tbody td {
            vertical-align: middle;
            padding-top: 16px;
            padding-bottom: 16px;
        }

        .issue-name {
            font-weight: 600;
            color: #0f172a;
        }

        .issue-sl {
            width: 72px;
            color: #64748b;
            font-weight: 600;
        }

        .issue-action-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 10px;
            border: 1px solid #dbe3ee;
            background: #fff;
            color: #334155;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .issue-action-link:hover {
            transform: translateY(-1px);
            border-color: #cbd5e1;
            background: #f8fafc;
            color: #0f172a;
        }

        .issue-action-link.delete-link {
            color: #dc2626;
        }

        .empty-issues {
            padding: 32px 24px;
            text-align: center;
            color: #64748b;
        }

        .modal-content {
            border: 0;
            border-radius: 18px;
            overflow: hidden;
        }

        .modal-header {
            background: #f8fafc;
            border-bottom: 1px solid #eef2f7;
        }

        .modal-body {
            padding: 24px;
        }

        @media (max-width: 767px) {
            .issues-panel .card-header,
            .issue-form-body {
                padding: 18px;
            }

            .issues-title {
                font-size: 1.2rem;
            }
        }
    </style>

    <section class="content issues-page">
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="card issues-panel issue-form-card">
                        <div class="card-header">
                            <h1 class="issues-title">Add Issue</h1>
                            <p class="issues-subtitle">Create a new issue for this selected volume.</p>
                        </div>
                        <div class="issue-form-body">
                            <form action="{{ URL('/add-issues/' . $id) }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label" for="issue_name">Issue Name</label>
                                    <input name="name" id="issue_name" class="form-control"
                                        placeholder="Enter issue name" />
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="issue_month">Month</label>
                                    <input name="month" id="issue_month" class="form-control"
                                        placeholder="Enter month" />
                                </div>

                                <div class="d-grid">
                                    <input type="submit" name="submit-issues" value="Save"
                                        class="btn btn-primary btn-block">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card issues-panel">
                        <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <div>
                                <h4 class="issues-title">Issue List</h4>
                                <p class="issues-subtitle mb-0">Manage existing issues and move into articles.</p>
                            </div>
                            <span class="badge bg-primary rounded-pill px-3 py-2">{{ count($issues) }} Total</span>
                        </div>

                        <div class="issue-list-body">
                            @if (count($issues))
                                <div class="issues-table-wrap">
                                    <table class="table table-hover issues-table">
                                        <thead>
                                            <tr>
                                                <th class="issue-sl">Sl</th>
                                                <th>Name</th>
                                                <th class="text-center">Edit</th>
                                                <th class="text-center">Delete</th>
                                                <th class="text-center">Add Article</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($issues as $data)
                                                <tr>
                                                    <td class="issue-sl">{{ $loop->index + 1 }}</td>
                                                    <td>
                                                        <div class="issue-name">{{ $data->name }}</div>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="#" class="issue-action-link edit-button"
                                                            data-bs-target="#editModal" data-id="{{ $data->id }}"
                                                            data-name="{{ $data->name }}" data-bs-toggle="modal"
                                                            title="Edit issue">
                                                            <i class="far fa-edit"></i>
                                                        </a>
                                                    </td>
                                                    <td class="text-center">
                                                        <a class="issue-action-link delete-link confirmation"
                                                            href="{{ URL('delete-issues/' . $data->id) }}"
                                                            title="Delete issue">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ URL('add-article/' . $data->id) }}"
                                                            class="btn btn-outline-primary btn-sm px-3">
                                                            Add Article
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="empty-issues">
                                    No issues have been added yet for this volume.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                aria-hidden="true">

                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Issue</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="editForm" method="POST" action="{{ url('update-issues') }}">
                                @csrf
                                <input type="hidden" id="edit-id" name="id">
                                <div class="form-group mb-3">
                                    <label for="edit-name">Name</label>
                                    <input type="text" class="form-control" id="edit-name" name="name" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </form>

                            {{-- <form method="POST" action="{{url('update-issues')}}">
                                @csrf
                                <input type="hidden" id="edit-id" name="id">
                                <div class="form-group">
                                    <label for="edit-name">Name</label>
                                    <input type="text" class="form-control" id="edit-name" name="name" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </form> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- url: 'http://127.0.0.1:8000/update-issues', -->

@endsection
@section('script2')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle edit button click
            document.querySelectorAll('.edit-button').forEach(function(button) {
                button.addEventListener('click', function() {
                    var id = this.getAttribute('data-id');
                    var name = this.getAttribute('data-name');

                    document.getElementById('edit-id').value = id;
                    document.getElementById('edit-name').value = name;

                    $('#editModal').modal('show');
                });
            });

            return;

            document.getElementById('editForm').addEventListener('submit', function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                fetch('/update-issues', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                        },
                        body: formData,
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            $('#editModal').modal('hide');
                            location.reload();
                        } else {
                            alert('Error updating issue');
                        }
                    })
                    .catch(error => {
                        console.error('Error updating issue:', error);
                        alert('Error updating issue');
                    });
            });
        });
    </script>

@endsection
