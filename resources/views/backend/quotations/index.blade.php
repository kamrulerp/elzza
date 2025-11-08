@extends('backend.layouts.app')

@section('main')
<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Quotations</h3>
                    <div class="card-tools">
                        <a href="{{ route('quotations.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Create New Quotation
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Product</th>
                                    <th>Timeframe</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($quotations as $quotation)
                                <tr>
                                    <td>{{ $quotation->id }}</td>
                                    <td>{{ $quotation->name }}</td>
                                    <td>{{ $quotation->email }}</td>
                                    <td>{{ $quotation->phone }}</td>
                                    <td>{{ $quotation->address }}</td>
                                    <td>{{ $quotation->product_type }}</td>
                                    <td>{{ $quotation->execution_timeframe }}</td>
                                    <td>{{ $quotation->description }}</td>
                                    <td>
                                        
                                            {{ ucfirst($quotation->status) }}
                                        
                                    </td>
                                    <td>
                                        <a href="{{ route('quotations.show', $quotation) }}" class="btn btn-info btn-sm">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('quotations.edit', $quotation) }}" class="btn btn-primary btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('quotations.destroy', $quotation) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-3">
                        {{ $quotations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection