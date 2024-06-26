@extends('template')

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Data Pembayaran</h1>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <div class="row mt-5">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                            <div class="row">
                                <div class="col-lg-4     col-md-6 col-sm-12 col-xl-4">
                                    <div class="card overflow-hidden">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h6 class="">Total Siswa Lunas</h6>
                                                    <h3 class="mb-2 number-font">1.252</h3>
                                                    <p class="text-muted mb-0">
                                                        <span class="text-primary"><i
                                                                class="fa fa-chevron-circle-up text-primary me-1"></i>
                                                            90%</span> siswa telah melunasi.
                                                    </p>
                                                </div>
                                                <div class="col col-auto">
                                                    <div
                                                        class="counter-icon bg-primary-gradient box-shadow-primary brround ms-auto">
                                                        <i class="fe fe-trending-up text-white mb-5 "></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 col-xl-4">
                                    <div class="card overflow-hidden">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h6 class="">Total Siswa Belum Lunas</h6>
                                                    <h3 class="mb-2 number-font">113</h3>
                                                    <p class="text-muted mb-0">
                                                        <span class="text-secondary"><i
                                                                class="fa fa-chevron-circle-up text-secondary me-1"></i>
                                                            10%</span> siswa belum melakukan pembayaran.
                                                    </p>
                                                </div>
                                                <div class="col col-auto">
                                                    <div
                                                        class="counter-icon bg-danger-gradient box-shadow-danger brround  ms-auto">
                                                        <i class="icon icon-rocket text-white mb-5 "></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 col-xl-4">
                                    <div class="card overflow-hidden">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h6 class="">Total Pembayaran</h6>
                                                    <h3 class="mb-2 number-font">Rp 863.521.220</h3>
                                                    <p class="text-muted mb-0">
                                                        <span class="text-success"><i
                                                                class="fa fa-chevron-circle-down text-success me-1"></i>
                                                            5%</span> dari nilai sebelumnya
                                                    </p>
                                                </div>
                                                <div class="col col-auto">
                                                    <div
                                                        class="counter-icon bg-secondary-gradient box-shadow-secondary brround ms-auto">
                                                        <i class="fe fe-dollar-sign text-white mb-5 "></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-sm">
                    <div class="">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Daftar Tagihan Semester</h3>
                                @if (Auth::user()->role == 'Mahasantri')
                                    <p class="ms-auto">
                                    <button type="submit" class="btn btn-danger rounded-0" id="pay-button" data-token="{{$token['invoice'] != null ? $token['invoice']->snap_token : ''}}" {{$token['invoice'] != null ? '' : 'disabled'}}>{{$token['invoice'] != null ? 'Bayar Sekarang' : 'Tidak Ada Tagihan'}}</button>
                                </p>
                                @endif

                            </div>
                            <div class="card-body">
                                <form action="{{route("pembayaran.store")}}" method="POST">
                                    @csrf
                                <div class="panel-group1" id="accordion1">
                                    @foreach ($data as $i => $item)
                                        <div class="panel panel-default mb-4">
                                            <div class="panel-heading1 ">
                                                <h4 class="panel-title1">
                                                    <a class="accordion-toggle collapsed" data-bs-toggle="collapse" data-bs-parent="#accordion" href="#collapse{{$i+1}}" aria-expanded="false" disabled>Semester {{$item['semester']}}  ({{$item['status']}})</a>
                                                </h4>

                                            </div>
                                            <div id="collapse{{$i+1}}" class="panel-collapse collapse" role="tabpanel" aria-expanded="false">
                                                <div class="panel-body">
                                                    @if ($item['status'] == 'Belum Berjalan')
                                                        <h1>Semester Belum Di mulai</h1>
                                                    @else
                                                        <div class="form-group m-0">
														<div class="custom-controls-stacked ">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        @if (Auth::user()->role == "Mahasantri")
                                                                            <th></th>
                                                                        @endif

                                                                        <th>jenis pembayaran</th>
                                                                        <th>Jatuh Tempo</th>
                                                                        <th>Nominal</th>
                                                                        <th>Sudah Dibayar</th>
                                                                        <th>Status</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                    @foreach ($item['payment_type'] as $pt)
                                                                        <tr>
                                                                            @if (Auth::user()->role == "Mahasantri")
                                                                            <td class="text-center">
                                                                                <input class="form-check-input toggleColspan {{$pt['status_code'] == 2 ? 'bg-dark' : ''}}" type="checkbox" name="paymentJenis[]" value="{{ json_encode(['semester' => $i+1, 'payment_type' => $pt['pyment_id']]) }}" id="#toggleColspan" data-payment="{{$pt['id']}}" aria-expanded="false" {{$pt['status_code'] == 2 ? 'disabled' : ''}}>
                                                                            </td>
                                                                            @endif

                                                                            <td>
                                                                                {{$pt['type']}}
                                                                            </td>
                                                                            <td>
                                                                                {{-- {{$pt['type']}} --}}
                                                                            </td>
                                                                            <td>
                                                                                {{App\Helpers\Formater::RupiahCurrency($pt['total'])}}
                                                                            </td>
                                                                            <td>
                                                                                {{App\Helpers\Formater::RupiahCurrency($pt['sudah_dibayar'])}}
                                                                            </td>
                                                                            <td>
                                                                                <h5 class="{{$pt['status_code'] == 1 ? 'text-danger' : 'text-success'}}">{{$pt['status_text']}}</h5>
                                                                            </td>

                                                                        </tr>
                                                                        <tr >
                                                                           <td colspan="4" id="{{$pt['id']}}">
                                                                                <div class="row">
                                                                                    <label class="col-md-3 form-label" for="nama">Jumlah bayar :</label>
                                                                                    <div class="col-md-9">
                                                                                        <input class="form-control numericInput inputNominal"
                                                                                            type="input" id="{{$pt['id']}}" autocomplete="off"
                                                                                            value="{{$pt['total']}}" {{$pt['type_code'] != 1 ? '': 'readonly'}} data-target="{{$pt['id']}}">
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
														</div>
													</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    @if (Auth::user()->role == "Mahasantri")
                                        <div class="summary border border-solid p-4">
                                        <h3 class="underline">Summary Pembayaran</h3>
                                        <table class="table">
                                            <thead >
                                                <tr>
                                                    <th>Jenis Pembayaran</th>
                                                    <th>Nominal</th>
                                                </tr>
                                            </thead>
                                            <tbody class="summary-body">
                                            </tbody>
                                            <tr class="table-success">
                                                <td><strong>Total</strong></td>
                                                <td class="totals">0</td>
                                            </tr>
                                        </table>
                                        <button type="submit" class="btn btn-success" id="submit">SEND</button>
                                    </div>
                                    @endif

                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Row -->
            </div>
        </div>
    </div>
    <!-- CONTAINER CLOSED -->
    </div>
    @push('custom')
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
        <!-- SweetAlert2 JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
        <script>
            $(document).ready(function () {

                // Hide the initially colspanned row
                $('td[colspan]').hide();

                // Handle checkbox change event
                $('.toggleColspan').change(function () {
                    var inputValue = $(this).attr('data-payment');
                        var detec = '#'+inputValue
                    if ($(this).is(':checked')) {
                        var inputDetect = detec+ ' input'
                        var specificChildElements = $(inputDetect).val();
                        var neWElement = '<tr class="input-'+inputValue+'"><td>'+inputValue+'</td><td class="perUnit perunit-'+inputValue+'">'+specificChildElements+'</td></tr>'
                        $(inputDetect).attr('name', 'value[]');
                        $('.summary-body').append(neWElement)
                        $(detec).show();
                    } else {
                        var checkElementRemove = '.input-'+inputValue

                        $(checkElementRemove).remove()
                        $(detec).hide();
                    }
                    GetTotal()
                });
                $('.inputNominal').on('keyup', function() {
                    var getValueAttr = $(this).attr('data-target')
                    var detec = '.perunit-'+getValueAttr
                    $(detec).html($(this).val())
                    GetTotal()
                });
                function GetTotal(){
                    var sum = 0;
                    $('.perUnit').each(function() {
                        sum += parseFloat($(this).html());
                    });
                    $('.totals').html(sum)
                }

            });


        </script>
        <script src="{{$token['url']}}" data-client-key="{{$token['clienKey']}}"></script>
        <script type="text/javascript">
            $('#pay-button').on('click', function(){
                let a = $('#pay-button').attr('data-token');
                mid(a);
            });

            @if(Session::has('successe'))
            $(window).load(function(){
                let a = $('#pay-button').attr('data-token');
                mid(a);
            });
            @endif



            let mid = (a) => {
                        snap.pay(a, {
                        uiMode: "qr",
                        // Optional
                        onSuccess: function(result){
                            // /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                            // toastr.info("Silahikan Tunggu Konfirmasi", "Info!");
                        },
                        // Optional
                        onPending: function(result){
                            // /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                            // toastr.success("Berhasil Melakukan Pembayaran", "Success!");
                            // console.log('Pending');
                            // toastr.info("Silahikan Tunggu Konfirmasi", "Info!");
                            @if(Session::has('successe'))
                            const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                confirmButton: 'btn btn-danger rounded-0 w-100',
                            },
                            buttonsStyling: false
                            })
                            @endif
                        },
                        // Optional
                        onError: function(result){
                            // /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                            // toastr.error("Gagal Melakukan Pembayarn!", "Success!");
                            // console.log('err');
                            // toastr.info("Silahikan Tunggu Konfirmasi", "Info!");
                        }
                    })
                }

            </script>

        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: '{{ session('success') }}',
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ session('error') }}',
                });
            </script>

        @endif
    @endpush
@endsection
