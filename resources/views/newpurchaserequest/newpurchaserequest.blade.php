@extends('layout.app-main', ['accesslevelid' => $LoggedUserInfo['accesslevel'],'username' => $LoggedUserInfo['username']])

@section('title', 'AMS | purchase request')

@section('dependencies')
    <link rel="stylesheet" href="{{ asset('css/components/global/pr-and-jo/pr-and-jo.css') }}">
@stop

@section('content')
    <div class="d-block py-5">
        <form id="request-form" action="">

            @csrf

            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-9">

                        <x-pr-form></x-pr-form>

                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="card">
                            <div class="card-header bg-primary">
                                <span class="text-white" role="header">FILES</span>
                            </div>
                            <div class="card-body">
                                <div id="file-content-id" class="d-block"></div>
                                <input id="file-pick-id" class="d-none" type="file" name="file[]" accept="image/.jpeg,.png,.pdf" multiple>
                                <button class="btn w-100 border border-primary text-primary" for="file-pick-id" type="button" onclick="javascript:$('#file-pick-id').click()">
                                    <i class="fa fa-upload"></i>
                                    <span role="text">UPLOAD FILES</span>
                                </button>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary w-100 text-light" type="button">
                                    <i class="fa fa-paper-plane"></i>
                                    <span role="text">SEND REQUEST</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop

@section('javascript')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/components/pr-form/pr-form.js') }}"></script>
    <script>
        $(document).ready((evt) => {

            $('[data-bs-toggle="tooltip"]').tooltip();

        });
    </script>
@stop




