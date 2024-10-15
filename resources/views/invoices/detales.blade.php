@extends('layouts.master')
@section('css')
<!---Internal  Prism css-->
<link href="{{URL::asset('assets/plugins/prism/prism.css')}}" rel="stylesheet">
<!---Internal Input tags css-->
<link href="{{URL::asset('assets/plugins/inputtags/inputtags.css')}}" rel="stylesheet">
<!--- Custom-scroll -->
<link href="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">قائمة الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تفاصيل الفاتورة</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')

    @if (session()->has('delete'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('delete') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

				<!-- row opened -->
				<div class="row row-sm">
					<div class="col-lg-12 col-md-12">
						<div class="card" id="basic-alert">
							<div class="card-body">
								<div class="text-wrap">
									<div class="example">
										<div class="panel panel-primary tabs-style-1">
											<div class=" tab-menu-heading">
												<div class="tabs-menu1">
													<!-- Tabs -->
													<ul class="nav panel-tabs main-nav-line">
														<li class="nav-item"><a href="#tab1" class="nav-link active" data-toggle="tab"> معلومات الفاتورة</a></li>
														<li class="nav-item"><a href="#tab2" class="nav-link" data-toggle="tab"> حالات الدفع </a></li>
														<li class="nav-item"><a href="#tab3" class="nav-link" data-toggle="tab"> مرفقات الفاتورة</a></li>
													</ul>
												</div>
											</div>
											<div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">
												<div class="tab-content">
													<div class="tab-pane active" id="tab1">
                                                        <div class="row">

                                                            <div class="col-xl-12">
                                                                <div class="card mg-b-20">
                                                                    <div class="card-body">
                                                                        <div class="table-responsive">
                                                                            <table id="example1" class="table key-buttons text-md-nowrap">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <th class="border-bottom-0" scope="row">رقم الفاتورة</th>
                                                                                        <td>{{ $invoice->invoice_number }}</td>
                                                                                        <th class="border-bottom-0" scope="row">تاريخ الفاتورة </th>
                                                                                        <td>{{ $invoice->invoice_date }}</td>
                                                                                        <th class="border-bottom-0" scope="row">تاريخ الاستحقاق</th>
                                                                                        <td>{{ $invoice->due_date }}</td>
                                                                                        <th class="border-bottom-0" scope="row">القسم</th>
                                                                                        <td>{{ $invoice->section->section_name  }}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th class="border-bottom-0" scope="row"> المنتج</th>
                                                                                        <td>{{ $invoice->product }}</td>
                                                                                        <th class="border-bottom-0" scope="row"> مبلغ التحصيل</th>
                                                                                        <td>{{ $invoice->amount_collction }}</td>
                                                                                        <th class="border-bottom-0" scope="row"> مبلغ العمولة</th>
                                                                                        <td>{{ $invoice->amount_commission }}</td>
                                                                                        <th class="border-bottom-0" scope="row">الخصم</th>
                                                                                        <td>{{ $invoice->discount }}</td>
                                                                                    </tr>

                                                                                    <tr>
                                                                                        <th class="border-bottom-0" scope="row">نسبة الضربية</th>
                                                                                        <td>{{ $invoice->rate_vat }}</td>
                                                                                        <th class="border-bottom-0" scope="row">قيمة الضريبة</th>
                                                                                        <td>{{ $invoice->value_vat }}</td>
                                                                                        <th class="border-bottom-0" scope="row">الاجمالي</th>
                                                                                        <td>{{ $invoice->total }}</td>
                                                                                        <th class="border-bottom-0" scope="row">الحالة الحالية</th>
                                                                                        @if ($invoice->value_status == 1)
                                                                                            <td><span
                                                                                                    class="badge badge-pill badge-success">{{ $invoice->status }}</span>
                                                                                            </td>
                                                                                        @elseif($invoice->value_status ==2)
                                                                                            <td><span
                                                                                                    class="badge badge-pill badge-danger">{{ $invoice->status }}</span>
                                                                                            </td>
                                                                                        @else
                                                                                            <td><span
                                                                                                    class="badge badge-pill badge-warning">{{ $invoice->status }}</span>
                                                                                            </td>
                                                                                        @endif

                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th class="border-bottom-0" scope="row">ملاحظات </th>
                                                                                        <td>{{ $invoice->note }}</td>
                                                                                    </tr>



                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                         </div>
												 	</div>
													<div class="tab-pane" id="tab2">
                                                    <div class="row">

                                                            <div class="col-xl-12">
                                                                <div class="card mg-b-20">
                                                                    <div class="card-body">
                                                                        <div class="table-responsive">
                                                                            <table id="example1" class="table key-buttons text-md-nowrap">
                                                                                <thead>
                                                                                    <tr>
                                                                                    <th class="border-bottom-0" scope="row">#</th>
                                                                                    <th class="border-bottom-0" scope="row">رقم الفاتورة</th>
                                                                                    <th class="border-bottom-0" scope="row"> نوع المنتج</th>
                                                                                    <th class="border-bottom-0" scope="row"> القسم</th>
                                                                                    <th class="border-bottom-0" scope="row"> حالة الدفع</th>
                                                                                    <th class="border-bottom-0" scope="row"> تاريخ الدفع</th>
                                                                                    <th class="border-bottom-0" scope="row">  ملاحظات</th>
                                                                                    <th class="border-bottom-0" scope="row">  تاريخ الاضافة</th>
                                                                                    <th class="border-bottom-0" scope="row">  المستخدم</th>
                                                                                    </tr>





                                                                                </thead>
                                                                                <tbody>

                                                                                    @php
                                                                                        $i=1;
                                                                                    @endphp

                                                                                    @foreach ($detales as $x)
                                                                                        <tr>
                                                                                            <td>{{ $i++ }}</td>
                                                                                            <td>{{ $x->invoice_number }}</td>
                                                                                            <td>{{ $x->product }}</td>
                                                                                            <td>{{ $invoice->section->section_name  }}</td>
                                                                                            @if ($x->value_status == 1)
                                                                                                <td><span
                                                                                                        class="badge badge-pill badge-success">{{ $x->status }}</span>
                                                                                                </td>
                                                                                            @elseif($x->value_status ==2)
                                                                                                <td><span
                                                                                                        class="badge badge-pill badge-danger">{{ $x->status }}</span>
                                                                                                </td>
                                                                                            @else
                                                                                                <td><span
                                                                                                        class="badge badge-pill badge-warning">{{ $x->status }}</span>
                                                                                                </td>
                                                                                            @endif
                                                                                            <td>{{ $x->payment_date }}</td>
                                                                                            <td>{{ $x->note }}</td>
                                                                                            <td>{{ $x->created_at}}</td>
                                                                                            <td>{{ $x->user }}</td>
                                                                                        </tr>

                                                                                    @endforeach


                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                         </div>
													</div>


													<div class="tab-pane" id="tab3">
                                                        <div class="row">

                                                            <div class="card-body">
                                                                <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                                                                <h5 class="card-title">اضافة مرفقات</h5>
                                                                <form method="post" action="{{ url('/InvoiceAttachments') }}"
                                                                    enctype="multipart/form-data">
                                                                    {{ csrf_field() }}
                                                                    <div class="custom-file">
                                                                        <input type="file" class="custom-file-input" id="customFile"
                                                                            name="file_name" required>
                                                                        <input type="hidden" id="customFile" name="invoice_number"
                                                                            value="{{ $invoice->invoice_number }}">
                                                                        <input type="hidden" id="invoice_id" name="invoice_id"
                                                                            value="{{ $invoice->id }}">
                                                                        <label class="custom-file-label" for="customFile">حدد
                                                                            المرفق</label>
                                                                    </div><br><br>
                                                                    <button type="submit" class="btn btn-primary btn-sm "
                                                                        name="uploadedFile">تاكيد</button>
                                                                </form>
                                                            </div>

                                                        <br>
                                                            <div class="col-xl-12">
                                                                <div class="card mg-b-20">
                                                                    <div class="card-body">
                                                                        <div class="table-responsive">
                                                                            <table id="example1" class="table key-buttons text-md-nowrap">
                                                                                <thead>
                                                                                    <tr>
                                                                                    <th class="border-bottom-0" scope="row">#</th>
                                                                                    <th class="border-bottom-0" scope="row">اسم الملف</th>
                                                                                    <th class="border-bottom-0" scope="row">  قام بالاضافة</th>
                                                                                    <th class="border-bottom-0" scope="row"> تاريخ الاضافة</th>
                                                                                    <th class="border-bottom-0" scope="row">  العمليات</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>

                                                                                    @php
                                                                                        $i=1;
                                                                                    @endphp

                                                                                    @foreach ($attachments as $attachment)
                                                                                        <tr>
                                                                                            <td>{{ $i++ }}</td>
                                                                                            <td>{{ $attachment->file_name }}</td>
                                                                                            <td>{{ $attachment->created_by  }}</td>
                                                                                            <td>{{ $attachment->created_at }}</td>
                                                                                            <td colspan="2">

                                                                                                <a class="btn btn-outline-success btn-sm"
                                                                                                    href="{{ url('View_file') }}/{{ $invoice->invoice_number }}/{{ $attachment->file_name }}"
                                                                                                    role="button"><i class="fas fa-eye"></i>&nbsp;
                                                                                                    عرض</a>

                                                                                                <a class="btn btn-outline-info btn-sm"
                                                                                                    href="{{ url('download') }}/{{ $invoice->invoice_number }}/{{ $attachment->file_name }}"
                                                                                                    role="button"><i
                                                                                                        class="fas fa-download"></i>&nbsp;
                                                                                                    تحميل</a>


                                                                                                    <button class="btn btn-outline-danger btn-sm"
                                                                                                        data-toggle="modal"
                                                                                                        data-file_name="{{ $attachment->file_name }}"
                                                                                                        data-invoice_number="{{ $attachment->invoice_number }}"
                                                                                                        data-id_file="{{ $attachment->id }}"
                                                                                                        data-target="#delete_file">حذف</button>


                                                                                            </td>
                                                                                        </tr>

                                                                                    @endforeach


                                                                                </tbody>
                                                                            </table>
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
									</div>

                                </div>


                                 <!-- delete -->
    <div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">حذف المرفق</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('delete_file') }}" method="post" enctype="multipart/form-data">

                {{ csrf_field() }}
                <div class="modal-body">
                    <p class="text-center">
                    <h6 style="color:red"> هل انت متاكد من عملية حذف المرفق ؟</h6>
                    </p>

                    <input type="hidden" name="id_file" id="id_file" value="">
                    <input type="hidden" name="file_name" id="file_name" value="">
                    <input type="hidden" name="invoice_number" id="invoice_number" value="">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn btn-danger">تاكيد</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
@section('js')
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Jquery.mCustomScrollbar js-->
<script src="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- Internal Input tags js-->
<script src="{{URL::asset('assets/plugins/inputtags/inputtags.js')}}"></script>
<!--- Tabs JS-->
<script src="{{URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js')}}"></script>
<script src="{{URL::asset('assets/js/tabs.js')}}"></script>
<!--Internal  Clipboard js-->
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.js')}}"></script>
<!-- Internal Prism js-->
<script src="{{URL::asset('assets/plugins/prism/prism.js')}}"></script>


<script>
    $('#delete_file').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id_file = button.data('id_file')
        var file_name = button.data('file_name')
        var invoice_number = button.data('invoice_number')
        var modal = $(this)

        modal.find('.modal-body #id_file').val(id_file);
        modal.find('.modal-body #file_name').val(file_name);
        modal.find('.modal-body #invoice_number').val(invoice_number);
    })

</script>

<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

</script>


@endsection
