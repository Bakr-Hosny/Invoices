@extends('layouts.master')
@section('title')
الاقسام
@endsection
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ المنتجات</span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('content')


                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session()->has('Addpro'))
                    <div class="alert alert-success alert_dismissaible fade show" role="alert">
                        <strong>{{ session()->get('Addpro') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif


                @if (session()->has('Error'))
                <div class="alert alert-danger alert_dismissaible fade show" role="alert">
                    <strong>{{ session()->get('Error') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                @if (session()->has('Editpro'))
                <div class="alert alert-success alert_dismissaible fade show" role="alert">
                    <strong>{{ session()->get('Editpro') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                @if (session()->has('deletepro'))
                <div class="alert alert-danger alert_dismissaible fade show" role="alert">
                    <strong>{{ session()->get('deletepro') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif


				<!-- row -->


                <div class="row">



                    <div class="col-xl-12">
                        <div class="card mg-b-20">

                            <div class="card-header pb-0">
                                                            <!-- Basic modal -->

                            <div class="col-sm-6 col-md-4 col-xl-3">
                                    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">اضافة منتج</a>
                            </div>
                            <div class="modal" id="modaldemo8">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content modal-content-demo">
                                        <div class="modal-header">
                                            <h6 class="modal-title">اضافة منتج</h6>
                                            <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">


                                            <form action="{{ route('products.store') }}" method="post">
                                                {{ csrf_field() }}


                                                <div class="form-group">
                                                   <label for="exampleInputEmail1">اسم المنتج</label>
                                                   <input type="text" class="form-control" id="product_name" name="product_name" >
                                                </div>

                                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref"> القسم</label>
                                                <select class="form-control" id="section_id" name="section_id" required>
                                                    <option value="" selected disabled>--حدد القسم--</option>
                                                    @foreach ($sections as $section)
                                                    <option value="{{ $section->id }}"> {{$section->section_name  }}</option>
                                                    @endforeach
                                                </select>

                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">ملاحظات</label>
                                                    <textarea class="form-control" name="description" id="description"  rows="3"></textarea>
                                                </div>

                                                <div class="modal-footer">
                                                    <button class="btn ripple btn-primary" type="submit">تأكيد</button>
                                                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">أغلاق</button>
                                                </div>
                                            </form>


                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- End Basic modal -->
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table key-buttons text-md-nowrap">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0">#</th>
                                                <th class="border-bottom-0">اسم المنتج</th>
                                                <th class="border-bottom-0">اسم القسم</th>
                                                <th class="border-bottom-0">االملاحظات </th>
                                                <th class="border-bottom-0">العمليات</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 0;
                                            @endphp
                                                @foreach ($products as $product)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $product->product_name }}</td>
                                                    <td> {{ $product->section->section_name }} </td>
                                                    <td>{{ $product->description }}</td>
                                                    <td>
                                                        <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                        data-id="{{ $product->id }}" data-product_name="{{ $product->product_name }}"
                                                        data-section_name="{{ $product->section->section_name }}"
                                                        data-description="{{ $product->description }}" data-toggle="modal"
                                                        href="#exampleModal2" title="تعديل">تعديل</a>

                                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                        data-id="{{ $product->id }}"  data-product_name="{{ $product->product_name }}"
                                                         data-toggle="modal" href="#exampleModal3" title="حذف">حذف</a>

                                                    </td>

                                                </tr>

                                                @endforeach




                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                                        <!-- edit -->
                            <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">تعديل القسم</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form action="products/update" method="post" autocomplete="off">
                                            {{ method_field('patch') }}
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <input type="hidden" name="id" id="id" value="">
                                                <label for="recipient-name" class="col-form-label">اسم المنتج:</label>
                                                <input class="form-control" name="product_name" id="product_name" type="text" required>
                                            </div>

                                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">القسم</label>
                                            <select name="section_name" id="section_name" class="custom-select my-1 mr-sm-2" required>
                                                @foreach ($sections as $section)
                                                    <option >{{ $section->section_name }}</option>
                                                @endforeach
                                            </select>



                                            <div class="form-group">
                                                <label for="message-text" class="col-form-label">ملاحظات:</label>
                                                <textarea class="form-control" id="description" name="description" required></textarea>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">تاكيد</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                                           <!-- delete -->
                                           <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                           aria-hidden="true">
                                           <div class="modal-dialog" role="document">
                                               <div class="modal-content">
                                                   <div class="modal-header">
                                                       <h5 class="modal-title" id="exampleModalLabel"> حذف المنتج</h5>
                                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                           <span aria-hidden="true">&times;</span>
                                                       </button>
                                                   </div>
                                                   <div class="modal-body">
                                                    <form action="products/destroy" method="post">
                                                        {{ method_field('delete') }}
                                                        {{ csrf_field() }}
                                                        <div class="modal-body">
                                                            <p>هل انت متاكد من عملية الحذف ؟</p><br>
                                                            <input type="hidden" name="id" id="id" value="">
                                                            <input class="form-control" name="product_name" id="product_name" type="text" readonly>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                                            <button type="submit" class="btn btn-danger">تاكيد</button>
                                                        </div>
                                                </div>
                                                </form>

                                               </div>
                                           </div>
                                       </div>

				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
<script>
    $('#exampleModal2').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var product_name = button.data('product_name')
        var section_name = button.data('section_name')
        var description = button.data('description')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #product_name').val(product_name);
        modal.find('.modal-body #section_name').val(section_name);
        modal.find('.modal-body #description').val(description);
    })

</script>

<script>
    $('#exampleModal3').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var product_name = button.data('product_name')

        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #product_name').val(product_name);

    })

</script>
@endsection
