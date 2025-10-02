@extends('frontend.layout.layout')

@section('content')
    @include('frontend.inc.breadcrumb')

    <div class="site-section">
        <div class="container px-[1rem] md:px-[3rem] mx-auto">
            <div class="row mb-16">
                <div>
                    <h3>Remplissez le formulaire ci-dessous, et notre équipe vous répondra dans les plus brefs
                        délais.</h3>
                </div>
            </div>
            <div class="block md:flex justify-between items-center gap-8">
                <div class="w-full md:w-1/2">

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif


                    <form action="{{ route('contact.save') }}" method="post">
                        @csrf
                        <div class="space-y-4 w-full lg:w-[80%]">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <div class="form-group row">
                                    <div class="col-md-12 space-y-2">
                                        <label for="c_fname" class="text-black">Nom <span
                                                class="text-danger">*</span></label>
                                        <input type="text"
                                            class="px-[.5rem] py-[.8rem] border outline-none focus:ring-0 rounded-md w-full"
                                            id="c_fname" name="lastname" value="{{ old('lastname') }}">
                                    </div>
                                    @error('lastname')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12 space-y-2">
                                        <label for="c_fname" class="text-black">Prénom <span
                                                class="text-danger">*</span></label>
                                        <input type="text"
                                            class="px-[.5rem] py-[.8rem] border outline-none focus:ring-0 rounded-md w-full"
                                            id="c_fname" name="firstname" value="{{ old('firstname') }}">
                                    </div>
                                    @error('firstname')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12 space-y-2">
                                    <label for="c_email" class="text-black">Email <span
                                            class="text-danger">*</span></label>
                                    <input type="email"
                                        class="px-[.5rem] py-[.8rem] border outline-none focus:ring-0 rounded-md w-full"
                                        id="c_email" name="email" value="{{ old('email') }}" placeholder="">
                                </div>
                                @error('firstname')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12 space-y-2">
                                    <label for="c_subject" class="text-black">Objet <span
                                            class="text-danger">*</span></label>
                                    <input type="text"
                                        class="px-[.5rem] py-[.8rem] border outline-none focus:ring-0 rounded-md w-full"
                                        id="subject" name="subject" value="{{ old('subject') }}">
                                </div>
                                @error('subject')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12 space-y-2">
                                    <label for="c_message" class="text-black">Message<span
                                            class="text-danger">*</span></label>
                                    <textarea name="message" id="c_message" cols="30" rows="7"
                                        class="px-[.5rem] py-[.8rem] border outline-none focus:ring-0 rounded-md w-full"
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
                <div class="w-full md:w-1/2 mt-16 md:mt-0 h-[400px] md:w-1/2">
                    <div id="map" style="height:100%; width:100%; border-radius:20px"></div>
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
