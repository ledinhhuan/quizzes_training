@extends('layouts.admin.master')

@section('title', __('action.inprogress'))

@section('content')
    <div class="content" style="padding:0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card" style="margin:0">
                        <div class="card-content text-center">
                            <img src="{{ asset('assets/img/imgbin-work-in-progress-counter-strike-1-6-work-in-progress-mE3Ljmx4Ap4XuD13QF3PHjnNb.jpg') }}" style="" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/admin/material/js/topic-search.js') }}"></script>
@endsection
