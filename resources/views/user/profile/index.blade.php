@extends('user.layouts.main')

@section('content')
<link rel="stylesheet" href="/css/user/profile.css">

<div class="container content-profile">
    <h1 data-aos="zoom-in" data-aos-duration="2000" class="text-center">Profil Pengguna</h1>
    @if (session()->has('success'))
    @include('user.partials.alertSuccess')
    @endif

    <div class="row mt-5">
        <div class="col-lg-6 mx-auto my-auto">

            <div class="card card-isi shadow border-0" data-aos="zoom-in-up" data-aos-duration="2000">
                <form action="/profile/{{ $user->id }}" method="POST">
                    @csrf
                    @method('put')

                    <div class="mb-3">
                        <label for="first_name" class="form-label">Nama Depan</label>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name"
                            name="first_name" required value="{{ old('first_name', $user->first_name) }}">
                        @error('first_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="last_name" class="form-label">Nama Belakang</label>
                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name"
                            name="last_name" required value="{{ old('last_name', $user->last_name) }}">
                        @error('last_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Nomor Telpon</label>
                        <input type="number" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number"
                            name="phone_number" required value="{{ old('phone_number', $user->phone_number) }}">
                        @error('phone_number')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="team_name" class="form-label">Nama Tim</label>
                        <input type="text" class="form-control @error('team_name') is-invalid @enderror" id="team_name"
                            name="team_name" required value="{{ old('team_name', $user->team_name) }}">
                        @error('team_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" required value="{{ old('email', $user->email) }}" disabled>
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-simpan btn-block mt-5 mb-1" id="saveButton" disabled>Simpan</button>

                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        var profileForm = $('#profileForm');
        var saveButton = $('#saveButton');

        var firstNameInput = $('#first_name');
        var lastNameInput = $('#last_name');
        var phoneNumberInput = $('#phone_number');
        var teamNameInput = $('#team_name');

        function handleInputChange() {
            saveButton.prop('disabled', false);
        }

        var inputElements = [firstNameInput, lastNameInput, phoneNumberInput, teamNameInput];
        inputElements.forEach(function (input) {
            input.on('input', handleInputChange);
        });
    });
</script>

@endsection
