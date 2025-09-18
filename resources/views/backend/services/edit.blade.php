@extends('backend.layouts.app')

@section('main')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col-sm-6 mb-2">
                <h3 class="m-0">{{ __('Edit Service') }}</h3>
            </div>
            
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Edit Service') }}</h3>
            </div>
            
            <form action="{{ route('services.update', $service) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">{{ __('Service Title') }} <span class="text-danger">*</span></label> 
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                       id="title" name="title" value="{{ old('title', $service->title) }}" required>
                                @error('title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">{{ __('Status') }} <span class="text-danger">*</span></label>
                                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                    <option value="">{{ __('Select Status') }}</option>
                                    <option value="active" {{ old('status', $service->status) == 'active' ? 'selected' : '' }}>{{ __('Active') }}</option>
                                    <option value="inactive" {{ old('status', $service->status) == 'inactive' ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="description">{{ __('Description') }} <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="5" required>{{ old('description', $service->description) }}</textarea>
                        @error('description')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="icon">{{ __('Service Icon') }}</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('icon') is-invalid @enderror" 
                                       id="icon" name="icon" accept="image/*">
                                <label class="custom-file-label" for="icon">{{ __('Choose file') }}</label>
                            </div>
                        </div>
                        @error('icon')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        @if($service->icon)
                            <div class="mt-2">
                                <img src="{{ asset($service->icon) }}" alt="Current Icon" class="img-thumbnail" style="max-height: 100px">
                                <p class="text-muted">{{ __('Current Icon') }}</p>
                            </div>
                        @endif
                        <small class="form-text text-muted">{{ __('Accepted formats: JPEG, PNG, JPG, GIF, SVG. Max size: 2MB') }}</small>
                    </div>
                </div>
                
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">{{ __('Update Service') }}</button>
                    <a href="{{ route('services.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>        
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $(function() {
        // Initialize file input display
        bsCustomFileInput.init();
    });
</script>
@endpush