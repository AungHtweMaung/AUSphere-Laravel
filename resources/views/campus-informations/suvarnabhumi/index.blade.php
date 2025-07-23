@php
    use Illuminate\Support\Str;
@endphp

@extends('layouts.app', [
    'elementActive' => 'campus-informations.suvarnabhumi',
])

@section('css')
    <link rel="stylesheet" href="{{ asset('css/campus-infos.css') }}">
@endsection
@section('content')
    <div class="row mb-3">
        <div class="col-md-3">
            <h2 class="">Suvarnabhumi</h2>
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
                    <div class="row justify-content-center mb-5">
                        <div class="col-md-10">
                            <img src="{{ asset('campus-info-images/suvarnabhumi/Abac_Map_sv.jpg') }}" style="max-width: 100%"
                            alt="Campus Map" title="Campus Map of Suvarnabhumi">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-5">
                            <img src="{{ asset('campus-info-images/suvarnabhumi/Abac_Map_sv_ZoneA.jpg') }}" class="img-fluid"
                            alt="Campus Map" title="Campus Map of Suvarnabhumi">
                        </div>
                        <div class="col-md-4 mb-5">
                            <img src="{{ asset('campus-info-images/suvarnabhumi/Abac_Map_sv_ZoneB.jpg') }}" class="img-fluid"
                            alt="Campus Map" title="Campus Map of Suvarnabhumi">
                        </div>
                        <div class="col-md-4 mb-5">
                            <img src="{{ asset('campus-info-images/suvarnabhumi/Abac_Map_sv_ZoneC.jpg') }}" class="img-fluid"
                            alt="Campus Map" title="Campus Map of Suvarnabhumi">
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="location" role="tabpanel">

                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7755.515146344593!2d100.837917!3d13.611613!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311d430e775155f9%3A0xf01923824353260!2sAssumption%20University%20Suvarnabhumi%20Campus!5e0!3m2!1sen!2smm!4v1752515226322!5m2!1sen!2smm"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                        title="Google Map of Suvarnabhumi Campus" alt="Google Map of Suvarnabhumi Campus"></iframe>
                    </div>

                </div>
                <div class="tab-pane fade" id="info" role="tabpanel">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-body fw-bold">
                                    <h2 class="mb-3">Suvarnabhumi Campus</h2>
                                    <p>88 Moo 8 Bang Na-Trad Km. 26, Bang Sao Thong, Samut Prakan Thailand 10570</p>
                                    <p>Tel: (+66)-2783-2222</p>
                                    <p>E-mail: auweb@au.edu</p>
                                    <p>Bus Line: No.46, 132, 133, 533, 552, 537</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <img src="{{ asset('campus-info-images/suvarnabhumi/Suvarnabhumi Campus.webp') }}" style="width: 100%"
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
