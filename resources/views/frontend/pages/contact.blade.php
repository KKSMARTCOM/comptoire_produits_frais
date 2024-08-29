@extends('frontend.layout.layout')

@section('content')
    @include('frontend.inc.breadcrumb')

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div>
                    <h3>Remplissez le formulaire ci-dessous, et notre équipe vous répondra dans les plus brefs
                        délais.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif


                    <form action="{{ route('contact.save') }}" method="post">
                        @csrf
                        <div class="">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_fname" class="text-black">Nom <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_fname" name="lastname"
                                        value="{{ old('lastname') }}">
                                </div>
                                @error('lastname')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_fname" class="text-black">Prénom <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_fname" name="firstname"
                                        value="{{ old('firstname') }}">
                                </div>
                                @error('firstname')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_email" class="text-black">Email <span
                                            class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="c_email" name="email" placeholder="">
                                </div>
                            </div> --}}
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_subject" class="text-black">Objet </label>
                                    <input type="text" class="form-control" id="subject" name="subject"
                                        value="{{ old('subject') }}">
                                </div>
                                @error('subject')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_message" class="text-black">Message </label>
                                    <textarea name="message" id="c_message" cols="30" rows="7" class="form-control"
                                        aria-valuetext="{{ old('message') }}"></textarea>
                                </div>
                                @error('message')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group row mt-4">
                                <div class="col-lg-12">
                                    <button type="submit"
                                        class="btn btn-primary btn-lg btn-block border-0">Envoyer</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                {{-- <div class="col-md-5 ml-auto">
                    <div class="p-4 border mb-3">
                        <span class="d-block text-primary h6 text-uppercase text-black">Adresse</span>
                        <p class="mb-0">{!! 'Cotonou, Benin' !!}</p>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
