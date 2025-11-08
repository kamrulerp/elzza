@extends('backend.layouts.app')

@section('main')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">View Quotation</h3>
                    <div class="card-tools">
                        <a href="{{ route('quotations.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                        <a href="{{ route('quotations.edit', $quotation) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 200px"> Name</th>
                                <td>{{ $quotation->name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $quotation->email }}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{ $quotation->phone ?: 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td>{{ $quotation->description }}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{ $quotation->address }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <span class="badge badge-{{ $quotation->status == 'pending' ? 'warning' : ($quotation->status == 'approved' ? 'success' : 'danger') }}">
                                        {{ ucfirst($quotation->status) }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td>{{ $quotation->created_at->format('Y-m-d H:i:s') }}</td>
                            </tr>
                            <tr>
                                <th>Last Updated</th>
                                <td>{{ $quotation->updated_at->format('Y-m-d H:i:s') }}</td>
                            </tr>
                            <tr>
                                <th>Attached Files</th>
                                <td>
                                    @if($quotation->files->count() > 0)
                                        <ul class="list-unstyled">
                                            @foreach($quotation->files as $file)
                                                <li class="mb-2">
                                                    <a href="{{ asset('storage/' . $file->file_path) }}" 
                                                       target="_blank"
                                                       class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-download"></i> 
                                                        {{ $file->original_name }}
                                                        <small>({{ number_format($file->file_size / 1024, 2) }} KB)</small>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span class="text-muted">No files attached</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection