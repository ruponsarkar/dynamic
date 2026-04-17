@extends('adminpanel/layout')

@section('title', 'Home')
@section('breadcrumb', 'Add Volume')

@section('content')
    @php
        $volumesByJournal = $volume->groupBy('j_id');
    @endphp

    <style>
        .journal-volume-card {
            border: 1px solid #dee2e6;
            border-radius: 12px;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.05);
        }

        .journal-volume-card .card-header {
            background: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }

        .volume-grid {
            display: grid;
            gap: 12px;
        }

        .volume-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            padding: 14px 16px;
            border: 1px solid #e9ecef;
            border-radius: 10px;
            background: #fff;
        }

        .volume-actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .volume-item h5 {
            margin: 0;
            font-size: 1rem;
        }

        .volume-item p {
            margin: 4px 0 0;
            color: #6c757d;
        }

        .empty-volume-state {
            padding: 24px;
            text-align: center;
            border: 1px dashed #ced4da;
            border-radius: 10px;
            color: #6c757d;
            background: #fcfcfc;
        }
    </style>

    <section class="content">
        <div class="container-fluid">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row g-3">
                @foreach ($journal as $journalItem)
                    @php
                        $journalVolumes = $volumesByJournal->get($journalItem->j_id, collect());
                    @endphp

                    <div class="col-12">
                        <div class="card journal-volume-card">
                            <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                                <div>
                                    <h3 class="card-title mb-1">{{ $journalItem->j_name }}</h3>
                                    <div class="text-muted small">
                                        {{ $journalVolumes->count() }} volume{{ $journalVolumes->count() === 1 ? '' : 's' }}
                                    </div>
                                </div>

                                <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                    data-bs-target="#addVolumeModal{{ $journalItem->j_id }}">
                                    Add New Volume
                                </button>
                            </div>

                            <div class="card-body">
                                @if ($journalVolumes->isEmpty())
                                    <div class="empty-volume-state">
                                        No volumes added for this journal yet.
                                    </div>
                                @else
                                    <div class="volume-grid">
                                        @foreach ($journalVolumes as $volumeItem)
                                            <div class="volume-item">
                                                <div>
                                                    <h5>{{ $volumeItem->name }}</h5>
                                                    <p>Year: {{ $volumeItem->year ?: 'Not set' }}</p>
                                                </div>

                                                <div class="volume-actions">
                                                    <button class="btn btn-outline-secondary btn-sm" type="button"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editVolumeModal{{ $volumeItem->id }}">
                                                        Edit
                                                    </button>

                                                    <a href="{{ URL('add-issues/' . $volumeItem->id) }}"
                                                        class="btn btn-outline-primary btn-sm">
                                                        Manage Issues
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="addVolumeModal{{ $journalItem->j_id }}" tabindex="-1"
                        aria-labelledby="addVolumeModalLabel{{ $journalItem->j_id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="addVolumeModalLabel{{ $journalItem->j_id }}">
                                        Add Volume For {{ $journalItem->j_name }}
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="addVolume" method="post" enctype="multipart/form-data">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="volumeName{{ $journalItem->j_id }}" class="form-label">Volume
                                                Name</label>
                                            <input type="text" name="name" id="volumeName{{ $journalItem->j_id }}"
                                                class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label for="volumeYear{{ $journalItem->j_id }}"
                                                class="form-label">Year</label>
                                            <input type="year" name="year" id="volumeYear{{ $journalItem->j_id }}"
                                                class="form-control">
                                        </div>

                                        <input type="hidden" name="journal" value="{{ $journalItem->j_id }}">

                                        <div class="text-end">
                                            <input class="btn btn-primary" type="submit" name="submit-volume"
                                                value="Save">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    @foreach ($journalVolumes as $volumeItem)
                        <div class="modal fade" id="editVolumeModal{{ $volumeItem->id }}" tabindex="-1"
                            aria-labelledby="editVolumeModalLabel{{ $volumeItem->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="editVolumeModalLabel{{ $volumeItem->id }}">
                                            Edit {{ $volumeItem->name }}
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ URL('update-volume') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $volumeItem->id }}">

                                            <div class="mb-3">
                                                <label for="editVolumeName{{ $volumeItem->id }}"
                                                    class="form-label">Volume Name</label>
                                                <input type="text" name="name"
                                                    id="editVolumeName{{ $volumeItem->id }}" class="form-control"
                                                    value="{{ $volumeItem->name }}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="editVolumeYear{{ $volumeItem->id }}"
                                                    class="form-label">Year</label>
                                                <input type="year" name="year"
                                                    id="editVolumeYear{{ $volumeItem->id }}" class="form-control"
                                                    value="{{ $volumeItem->year }}">
                                            </div>

                                            <div class="text-end">
                                                <button class="btn btn-primary" type="submit">Update Volume</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>
@endsection
