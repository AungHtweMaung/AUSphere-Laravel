@php
    use Illuminate\Support\Str;
@endphp

@extends('layouts.app', [
    'elementActive' => 'campus-informations.hua-mak',
])

@section('css')
    <link rel="stylesheet" href="{{ asset('css/campus-infos.css') }}">
@endsection
@section('content')
    <div class="row mb-3">
        <div class="col-md-3">
            <h2 class="">Hua Mak</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs mb-5" id="campusTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="map-tab" data-bs-toggle="tab" data-bs-target="#map" type="button"
                        role="tab">
                        Campus Map
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="location-tab" data-bs-toggle="tab" data-bs-target="#location"
                        type="button" role="tab">
                        Campus Location
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button"
                        role="tab">
                        Campus Info
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="campusTabContent">
                <div class="tab-pane fade show active" id="map" role="tabpanel">
                    <div class="text-center">
                        <img src="{{ asset('campus-info-images/hua-mak/AU_hm_map-update.jpg') }}" style="max-width: 100%"
                            alt="Campus Map" title="Campus Map of Hua Mak">
                    </div>
                </div>
                <div class="tab-pane fade" id="location" role="tabpanel">
                    {{-- <div class="text-center">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.426166641668!2d100.627902!3d13.7531546!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311d61e70c438407%3A0x1bfca2461e825f49!2sAssumption%20University!5e0!3m2!1sen!2smm!4v1752513594713!5m2!1sen!2smm"
                         max-width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div> --}}

                    <div class="ratio ratio-16x9">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.426166641668!2d100.627902!3d13.7531546!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311d61e70c438407%3A0x1bfca2461e825f49!2sAssumption%20University!5e0!3m2!1sen!2smm!4v1752513594713!5m2!1sen!2smm"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Google Map of Hua Mak Campus" alt="Google Map of Hua Mak Campus">
                        </iframe>
                    </div>

                </div>
                <div class="tab-pane fade" id="info" role="tabpanel">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body fw-bold">
                                    <h2 class="mb-3">Hua Mak Campus</h2>
                                    <p>592/3 Soi Ramkhamhaeng 24, Ramkhamhaeng Rd., Hua Mak, Bang Kapi, Bangkok Thailand
                                        10240</p>
                                    <p>Tel. (+66)-2783-2222</p>
                                    <p>E-mail: auweb@au.edu</p>
                                    <p>Bus Line: No.22, 40, 58, 60, 71, 92, 93, 99, 109, 113, 115, 126, 137, 168, 207</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <img src="{{ asset('campus-info-images/hua-mak/HuaMak Campus.jpg') }}" class="img-fluid"
                                alt="">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('js')
@endpush
