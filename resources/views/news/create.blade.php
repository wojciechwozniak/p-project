@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('status'))
                    <div class="alert alert-{{session('status')[0]}}" role="alert">
                        {{ session('status')[1] }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">{{ __('Add news') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('news.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                <textarea id="description"
                                          class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                          name="description" value="{{ old('description') }}"
                                          rows="7"
                                          required
                                          autofocus></textarea>
                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Active') }}</label>
                                <div class="col-md-6">
                                    <select class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                            name="is_active">
                                        <option
                                            value="{{\Illuminate\Support\Facades\Config::get('CONSTANS.STATE.ACTIVE')}}">
                                            Yes
                                        </option>
                                        <option
                                            value="{{\Illuminate\Support\Facades\Config::get('CONSTANS.STATE.INACTIVE')}}">
                                            No
                                        </option>
                                    </select> @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Add') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
