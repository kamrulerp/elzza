@extends('backend.layouts.app')

@section('main')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col-sm-6 mb-2">
                <h3 class="m-0">{{ __('Service Details') }}</h3>    
            </div>
            
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $service->title }}</h3>
                <div class="card-tools">
                    <a href="{{ route('services.edit', $service) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> {{ __('Edit') }}
                    </a>
                    <a href="{{ route('services.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> {{ __('Back') }}
                    </a>
                </div>
            </div>
            
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <table class="table table-bordered">
                            <tr>
                                <th width="200">{{ __('Title') }}:</th>
                                <td>{{ $service->title }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Description') }}:</th>
                                <td>{{ $service->description }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Status') }}:</th>
                                <td>
                                    {{ $service->status }}
                            
                                </td>
                            </tr>
                            <tr>
                                <th>{{ __('Created At') }}:</th>
                                <td>{{ $service->created_at->format('M d, Y H:i A') }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Updated At') }}:</th>
                                <td>{{ $service->updated_at->format('M d, Y H:i A') }}</td>
                            </tr>
                        </table>
                    </div>
                    
                    <div class="col-md-4">
                        @if($service->icon)
                            <div class="text-center">
                                <h5>{{ __('Service Icon') }}</h5>
                                <img src="{{ asset($service->icon) }}" alt="{{ __('Service Icon') }}" class="img-fluid img-thumbnail" style="max-height: 200px;">
                            </div>
                        @else
                            <div class="text-center text-muted">
                                <h5>{{ __('No Icon Available') }}</h5>
                                <i class="fas fa-image fa-3x"></i>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection