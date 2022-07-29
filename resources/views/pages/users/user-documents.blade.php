@extends('layout.under_dashboard')

@section('main-container')


    {{-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/assets/pages/data-table/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/ekko-lightbox/dist/ekko-lightbox.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/lightbox2/dist/css/lightbox.css">
 --}}
<script type="text/javascript">
//  $(document).ready(function(){
//         $(".delete").click(function(e){ alert('as');
//             $this  = $(this);
//             e.preventDefault();
//             var url = $(this).attr("href");
//             $.get(url, function(r){
//                 if(r.success){
//                     $this.closest("tr").remove();
//                 }
//             })
//         });
//     });
// $(document).ready(function(){
//         $(".enable").click(function(e){ alert('as');
//             $this  = $(this);
//             e.preventDefault();
//             var url = $(this).attr("href");
//             $.get(url, function(r){
//                 if(r.success){
//                     $this.closest("tr").remove();
//                 }
//             })
//         });
//     });
// $(document).ready(function(){
//         $(".desable").click(function(e){ alert('as');
//             $this  = $(this);
//             e.preventDefault();
//             var url = $(this).attr("href");
//             $.get(url, function(r){
//                 if(r.success){
//                     $this.closest("tr").remove();
//                 }
//             })
//         });
//     });
</script>


            <div class="page-header">
                <div class="page-header-title">
                    <h4>List Documents - {{ $user_data->first_name }} {{ $user_data->last_name }}</h4>
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="index-2.html">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ url('/') }}/dashboard/users/list">Users</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ url('/') }}/dashboard/users/list">List User Documents</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Page-header end -->
            <!-- Page-body start -->
            <div class="page-body">
                <!-- DOM/Jquery table start -->

                <div class="card">
                    <div class="card-block">
                        <div class="table-responsive dt-responsive">
                            <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Keywords</th>
                                        <th>Description</th>
                                        <th>Intro</th>
                                        <th>Created On</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($documents as $key => $document)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $document->title }} </td>
                                        <td>{{ $document->keyword }} </td>
                                        <td>{{ $document->content_long }} </td>
                                        <td>{{ $document->paragraph }}</td>
                                        <td>{{ date('d M,Y',strtotime($document->created_at)) }}</td>
                                        <td>
                                            @if ($document->status == 1)
                                            Active
                                            @else
                                            Inactive
                                            @endif
                                        </td>
                                        <td>
                                            {{-- {{ $user->status }} --}}
                                            @if ($document->status == 1)
                                            <a class="label label-inverse-primary enable" href='{{ url('/') }}/dashboard/user-documents/status_change/{{ $document->id }}/0'>Disable</a>
                                            @else
                                            <a class="label label-inverse-warning desable" href='{{ url('/') }}/dashboard/user-documents/status_change/{{ $document->id }}/1'>Enable</a>
                                            @endif
                                            
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- DOM/Jquery table end -->
            </div>

@endsection
