@extends('layouts.main-content-layout')

@section('title', 'Продолжение регистрации')

@section('main.content')
    <div class="card shadow-2 border">
        <div class="card-header">
            <div class="d-sm-flex justify-content-between">
                <div class="me-auto align-self-center">
                    <h5 class="card-title m-0">
                        <i class="fas fa-user-plus"></i>
                        {{ ('Продолжение регистрации (опционально)') }}
                    </h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('register.step2') }}" method="POST">
                @csrf
                <div class="row form-group mb-3 align-items-center">
                    <label for="full_name" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Полное имя') }}
                    </label>
                    <div class="col-md-6">
                        <input id="full_name" type="text" class="form-control @error('full_name') is-invalid @enderror"
                               name="full_name" value="@isset($user->full_name){{ $user->full_name }}@endisset">
                        @include('components.field-filling-error', ['error' => 'full_name'])
                    </div>
                </div>
                <div class="row form-group mb-3 align-items-center">
                    <label for="gender" class="col-md-4 col-form-label text-sm-end">
                        {{ __('genders.gender') }}
                    </label>
                    <fieldset class="col-md-6">
                        @foreach ($genders as $gender)
                            <div class="form-check form-check-inline">
                                <input id="gender" type="radio" class="form-check-input"
                                       name="gender" value="{{ $gender }}"
                                       @if (isset($user) && $user->gender === $gender) checked @endif>
                                <label class="form-check-label" for="gender">{{ __("genders.list.$gender") }}</label>
                            </div>
                        @endforeach
                    </fieldset>
                </div>
                <div class="row form-group mb-3 align-items-center">
                    <label for="birth_date" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Дата рождения') }}
                    </label>
                    <div class="col-md-6">
                        <input id="birth_date" type="date"
                               class="form-control @error('birth_date') is-invalid @enderror"
                               name="birth_date" value="{{ $user->birth_date_str }}">
                        @include('components.field-filling-error', ['error' => 'birth_date'])
                    </div>
                </div>
                <div class="row form-group mb-3 align-items-center">
                    <label for="country" class="col-md-4 col-form-label text-sm-end">
                        {{ __('countries.country') }}
                    </label>
                    <div class="col-md-6">
                        <select id="country" class="form-select @error('country') is-invalid @enderror"
                                name="country" size="10">
                            <option value="">{{ __('countries.select') }}</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}"
                                        @if (isset($user) && $user->country_id === $country->id) selected @endif>
                                    {{ __("countries.list.$country->short_code") }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row form-group mb-3 align-items-center">
                    <label for="biography" class="col-md-4 col-form-label text-sm-end">
                        {{ ('О себе') }}
                    </label>
                    <div class="col-md-6">
                        <div class="form-outline">
                            <textarea id="biography" type="text" class="form-control" rows="4" name="biography">{{ $user->biography }}</textarea>
                            <label class="form-label" for="biography">{{ ('Расскажите что-нибудь о себе :)') }}</label>
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4">
                    <button type="submit" class="btn btn-primary">{{ ('Завершить регистрацию') }}</button>
                    <a class="btn btn-link" href="{{ url('/') }}">{{ ('Пропустить шаг') }}</a>
                </div>
            </form>
        </div>
    </div>
@endsection
