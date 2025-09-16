@extends('backend.layouts.app')

@section('main')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h3 class="m-0">General Settings</h3>
            </div>
           
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card card-primary card-outline mb-4">
            
            <form action="{{ route('general-settings.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="site_name">Site Name</label>
                                <input type="text" class="form-control @error('site_name') is-invalid @enderror" id="site_name" name="site_name" value="{{ old('site_name', $setting->site_name) }}" required>
                                @error('site_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label" for="site_email">Site Email</label>
                                <input type="email" class="form-control @error('site_email') is-invalid @enderror" id="site_email" name="site_email" value="{{ old('site_email', $setting->site_email) }}">
                                @error('site_email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label" for="site_phone">Site Phone</label>
                                <input type="text" class="form-control @error('site_phone') is-invalid @enderror" id="site_phone" name="site_phone" value="{{ old('site_phone', $setting->site_phone) }}">
                                @error('site_phone')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label" for="site_address">Site Address</label>
                                <textarea class="form-control @error('site_address') is-invalid @enderror" id="site_address" name="site_address" rows="3">{{ old('site_address', $setting->site_address) }}</textarea>
                                @error('site_address')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="logo">Logo</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('logo') is-invalid @enderror" id="logo" name="logo">
                                        <label class="custom-file-label" for="logo">Choose file</label>
                                    </div>
                                </div>
                                @error('logo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @if($setting->logo)
                                    <div class="mt-2">
                                        <img src="{{ asset($setting->logo) }}" alt="Logo" class="img-thumbnail" style="max-height: 100px">
                                    </div>
                                @endif
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label" for="favicon">Favicon</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('favicon') is-invalid @enderror" id="favicon" name="favicon">
                                        <label class="custom-file-label" for="favicon">Choose file</label>
                                    </div>
                                </div>
                                @error('favicon')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @if($setting->favicon)
                                    <div class="mt-2">
                                        <img src="{{ asset($setting->favicon) }}" alt="Favicon" class="img-thumbnail" style="max-height: 50px">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Social Media URLs -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Social Media Links</h5>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="facebook_url">Facebook URL</label>
                                <input type="url" class="form-control" id="facebook_url" name="facebook_url" value="{{ old('facebook_url', $setting->facebook_url) }}">
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label" for="twitter_url">Twitter URL</label>
                                <input type="url" class="form-control" id="twitter_url" name="twitter_url" value="{{ old('twitter_url', $setting->twitter_url) }}">
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label" for="instagram_url">Instagram URL</label>
                                <input type="url" class="form-control" id="instagram_url" name="instagram_url" value="{{ old('instagram_url', $setting->instagram_url) }}">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="linkedin_url">LinkedIn URL</label>
                                <input type="url" class="form-control" id="linkedin_url" name="linkedin_url" value="{{ old('linkedin_url', $setting->linkedin_url) }}">
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label" for="youtube_url">YouTube URL</label>
                                <input type="url" class="form-control" id="youtube_url" name="youtube_url" value="{{ old('youtube_url', $setting->youtube_url) }}">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
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