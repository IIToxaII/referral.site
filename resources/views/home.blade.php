@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-md-right">
                            {{ __('Money') }}
                        </div>
                        <div class="col-md-8 text-md-right">
                            {{ $money }}
                        </div>
                    </div>
                    @if (isset($refLink))
                        <div class="row">
                            <div class="col-md-4 text-md-right">
                                {{ __('Referral link') }}
                            </div>
                            <div class="col-md-8 text-md-right">
                                {{ url("/register?ref=$refLink") }}
                            </div>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('recharge') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="money" class="col-md-4 col-form-label text-md-right">{{ __('Money') }}</label>

                            <div class="col-md-6">
                                <input id="money" type="number" step="0.01" class="form-control" name="money" value="{{ old('money') }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
