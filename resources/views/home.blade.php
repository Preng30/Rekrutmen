@extends('master')

@php
    $user = auth()->user()
@endphp

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body d-flex">
                    
                    <table>
                        <tbody>
                            <tr>
                                <td>Nama Depan</td>
                                <td style="padding-inline: 1rem">:</td>
                                <td>{{ $user->nama_depan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Nama belakang</td>
                                <td style="padding-inline: 1rem">:</td>
                                <td>{{ $user->nama_belakang ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>No. HP</td>
                                <td style="padding-inline: 1rem">:</td>
                                <td>{{ $user->hp ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td style="padding-inline: 1rem">:</td>
                                <td>{{ $user->email ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Foto</td>
                                <td style="padding-inline: 1rem">:</td>
                                <td>
                                    @isset ($user->foto)
                                        <img src="/image/user/{{ $user->foto }}" style="max-width: 100%;">
                                    @else
                                        -
                                    @endisset
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <input type="submit" value="Log Out" class="btn btn-primary mt-3">
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>

            </div>

            
        </div>
        <div class="card">
            <div class="card-title">
                <h5 class="p-3">Ubah Profil</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('profile.update', $user->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("put")

                    <div class="form-group">
                        <label for="nama_depan">Nama Depan</label>
                        <input class="form-control" type="text" name="nama_depan" id="nama_depan" value="{{ old("nama_depan", $user->nama_depan) }}">
                    </div>
                    <div class="form-group">
                        <label for="nama_belakang">Nama Belakang</label>
                        <input class="form-control" type="text" name="nama_belakang" id="nama_belakang" value="{{ old("nama_belakang", $user->nama_belakang) }}">
                    </div>
                    <div class="form-group">
                        <label for="hp">No. HP</label>
                        <input class="form-control" type="text" name="hp" id="hp" value="{{ old("hp", $user->hp) }}">
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input class="form-control" type="file" name="foto" id="foto">
                    </div>

                    <input type="submit" value="Simpan" class="btn btn-primary mt-3">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
