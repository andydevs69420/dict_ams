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
                        <?php
                            $requester = $LoggedUserInfo['lastname'].', '. $LoggedUserInfo['firstname']. ' '.$LoggedUserInfo['middleinitial']; 
                            $requester_design = null;
                            // temporary, wala pa na edit ang registration form
                            /*
                                <option value=1>ITO 1</option>
                                <option value=2>ITO 2</option>
                                <option value=3>Enginner 1</option>
                                <option value=4>Enginner 2</option>
                                <option value=5>ISA 1</option>
                                <option value=6>PDO 1</option>
                                <option value=7>Regional Director</option>
                                <option value=8>Assistant Director</option>
                                <option value=9>Chief Admin</option>
                            */
                            switch ($LoggedUserInfo['designation']) {
                                case '1':
                                    $requester_design = 'ITO1 1';break;
                                case '2':
                                    $requester_design = 'ITO2 1';break;
                                case '3':
                                    $requester_design = 'Engineer 1';break;
                                case '4':
                                    $requester_design = 'Engineer 2';break;
                                case '5':
                                    $requester_design = 'ISA 1';break;
                                case '6':
                                    $requester_design = 'PDO 1';break;
                                case '7':
                                    $requester_design = 'Regional Director';break;
                                case '8':
                                    $requester_design = 'Assistant Director';break;
                                case '9':
                                    $requester_design = 'Chief Admin';break;
                                default:
                                    $requester_design = 'UNKNOWN';break;
                            }
                        ?>
                        <x-pr-form requester="{{ $requester }}" requester-design="{{ $requester_design }}" ></x-pr-form>

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




