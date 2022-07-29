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
                    <h4>List Templates</h4>
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="index-2.html">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Templates</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">List Templates</a>
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
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($template_types as $key => $template)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $template->name }}</td>
                                        <td>
                                            {{-- {{ $template->status }} --}}
                                            @if ($template->status == 1)
                                            <a class="label label-inverse-primary enable" href='{{ url('/') }}/dashboard/template-type/status_change/{{ $template->id }}/0'>Enable</a>
                                            @else
                                            <a class="label label-inverse-warning desable" href='{{ url('/') }}/dashboard/template-type/status_change/{{ $template->id }}/1'>Disable</a>
                                            @endif
                                            <a class="label label-inverse-info" href='{{ url('/') }}/dashboard/template-type/update/{{ $template->id }}'>Edit</a>
                                            <a class="label label-inverse-danger " href='{{ url('/') }}/dashboard/template-type/delete/{{ $template->id }}'>Delete</a>
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
