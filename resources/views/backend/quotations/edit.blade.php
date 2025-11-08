@extends('backend.layouts.app')
@section('main')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ isset($quotation) ? 'Edit Quotation' : 'Create New Quotation' }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('quotations.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ isset($quotation) ? route('quotations.update', $quotation) : route('quotations.store') }}" 
                          method="POST">
                        @csrf
                        @if(isset($quotation))
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <label for="name">Client Name <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', isset($quotation) ? $quotation->name : '') }}" 
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', isset($quotation) ? $quotation->email : '') }}" 
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" 
                                   class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" 
                                   name="phone" 
                                   value="{{ old('phone', isset($quotation) ? $quotation->phone : '') }}">
                        </div>

                        <div class="form-group">
                            <label for="description">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="4" 
                                      required>{{ old('description', isset($quotation) ? $quotation->description : '') }}</textarea>
                        </div>

                        

                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select class="form-control @error('status') is-invalid @enderror" 
                                    id="status" 
                                    name="status" 
                                    required>
                                <option value="pending" {{ (old('status', isset($quotation) ? $quotation->status : '') == 'pending') ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ (old('status', isset($quotation) ? $quotation->status : '') == 'approved') ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ (old('status', isset($quotation) ? $quotation->status : '') == 'rejected') ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                {{ isset($quotation) ? 'Update' : 'Create' }} Quotation
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection