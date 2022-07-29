@extends('layout.under_dashboard')

@section('main-container')

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
                    <h4>List Pricing</h4>
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="index-2.html">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Pricing</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">List Pricing</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Page-header end -->
            <!-- Page-body start -->
            <div class="page-body">
                <!-- DOM/Jquery table start -->


                {{-- HELLO : {{ session()->get('email') }} --}}
                <div class="card">
                    <div class="card-block">
                        <div class="table-responsive dt-responsive">
                            <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Plan Icon</th>
                                        <th>Plan Name</th>
                                        <th>Short Description</th>
                                        <th>Long Description</th>
                                        <th>Billable</th>
                                        <th>Billable Content</th>
                                        <th>Monthly Amount</th>
                                        <th>Yearly Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pricing as $key => $template)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $template->plan_icon }}</td>
                                        <td>{{ $template->plan_name }}</td>
                                        <td>{{ $template->short_desc }}</td>
                                        <td>{{ $template->long_desc }}</td>
                                        <td>{{ $template->billable }}</td>
                                        <td>{{ $template->billable_content }}</td>
                                        <td>{{ $template->monthly_amt }}</td>
                                        <td>{{ $template->yearly_amt }}</td>
                                        <td>
                                            {{-- {{ $template->status }} --}}
                                            @if ($template->status == 1)
                                            <a class="label label-inverse-primary enable" href='{{ url('/') }}/dashboard/pricing/status_change/{{ $template->id }}/0'>Enable</a>
                                            @else
                                            <a class="label label-inverse-warning desable" href='{{ url('/') }}/dashboard/pricing/status_change/{{ $template->id }}/1'>Disable</a>
                                            @endif
                                            <a class="label label-inverse-info" href='{{ url('/') }}/dashboard/pricing/update/{{ $template->id }}'>Edit</a>
                                            <a class="label label-inverse-danger " href='{{ url('/') }}/dashboard/pricing/delete/{{ $template->id }}'>Delete</a>
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
