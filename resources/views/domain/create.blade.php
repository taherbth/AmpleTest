@extends('layouts.app')

@section('content')
<div class="container mt-5" x-data="{ name: '', domain_name: '' }">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        <div class="card mt-4">
            <div class="card-header">Submitted Data</div>
            <div class="card-body">
                 <p><strong>Domain name:</strong> {{ session('data')['domain_name'] }}</p>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('domains.store') }}">
        @csrf       
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="mb-3">
                    <label for="domain_name" class="form-label">Please enter urls( Allowed over 5000 domain at a time, each separated by new line)</label>
                    <textarea id="domain_name" name="domain_name" x-model="domain_name"  class="form-control @error('domain_name') is-invalid @enderror" rows="5" maxlength="1000" placeholder="www.xyz.com/about  &#10;www.abc.com/details" required> {{ old('domain_name') }} </textarea>
                    @error('domain_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>     
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
