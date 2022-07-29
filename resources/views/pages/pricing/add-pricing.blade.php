@extends('layout.under_dashboard')

@section('main-container')

<style>
    .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }

    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked + .slider {
      background-color: #2196F3;
    }

    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }
</style>

            <div class="page-header">
                <div class="page-header-title">
                    <h4>Pricing</h4>
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
                        <li class="breadcrumb-item"><a href="#!">Add Pricings</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Page header end -->
            <!-- Page body start -->
            <div class="page-body">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- Basic Form Inputs card start -->
                        <div class="card">
                            <div class="card-header">
                                <h5>Add Pricing</h5>
                                <div class="card-header-right">
                                    <i class="icofont icofont-rounded-down"></i>
                                    <i class="icofont icofont-refresh"></i>
                                    <i class="icofont icofont-close-circled"></i>
                                </div>
                            </div>
                            <div class="card-block">
                             <div class="col-sm-8">
                                 <div class="validation_errors_alert">

                                </div>
                            </div>
                             <div class="col-sm-8">
                               <form action="{{ url('/') }}/dashboard/pricing/add" method="post">
                                @csrf
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Plan Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="plan_name" class="form-control" placeholder="Enter Plan Name" value="" />
                                        </div>
                                        @if ($errors->any())
                                        <span></span>
                                        @endif
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Short Description</label>
                                        <div class="col-sm-10">
                                            <textarea name="short_desc" class="form-control" id="short_desc" placeholder="Enter short description." cols="30" rows="10"></textarea>
                                        </div>
                                        @if ($errors->any())
                                        <span></span>
                                        @endif
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Long Description</label>
                                        <div class="col-sm-10">
                                            <textarea name="long_desc" class="form-control" id="long_desc" placeholder="Enter long description." cols="30" rows="10"></textarea>
                                        </div>
                                        @if ($errors->any())
                                        <span></span>
                                        @endif
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Billable</label>
                                        <div class="col-sm-10">
                                            <label class="switch">
                                                <input type="checkbox" id="billable" name="billable" value="1" onchange="change_billable_content();">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                        @if ($errors->any())
                                        <span></span>
                                        @endif
                                    </div>
                                    <div class="form-group row" id="billable_content_div" style="display: none">
                                        <label class="col-sm-2 col-form-label">Billable Content</label>
                                        <div class="col-sm-10">
                                            <textarea name="billable_content" class="form-control" id="billable_content" placeholder="Enter Billable Content." cols="30" rows="10"></textarea>
                                        </div>
                                        @if ($errors->any())
                                        <span></span>
                                        @endif
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Monthly Amount</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="monthly_amt" class="form-control" placeholder="Enter Monthly amount" value="" />
                                        </div>
                                        @if ($errors->any())
                                        <span></span>
                                        @endif
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Yearly Amount</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="yearly_amt" class="form-control" placeholder="Enter Yearly amount" value="" />
                                        </div>
                                        @if ($errors->any())
                                        <span></span>
                                        @endif
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Plan Icon</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="plan_icon" class="form-control" />
                                        </div>
                                        @if ($errors->any())
                                        <span></span>
                                        @endif
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-10">
                                            <button type="submit" name="submit" class="btn btn-primary">Add Pricing</button>
                                        </div>
                                    </div>
                                    <textarea id="description" style="visibility: hidden;"></textarea>

                                </form>
                               </div>

                                </div>
                            </div>
                        </div>
                        <!-- Basic Form Inputs card end -->

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            {{$error}}
                        @endforeach
                    @endif
@endsection


<script>
    function change_billable_content(){
        if(document.getElementById('billable').checked){
            console.log('Show billable content.');
            document.getElementById('billable_content_div').style.display = "flex";
        }
        else{
            console.log('Hide billable content.');
            document.getElementById('billable_content_div').style.display = "none";
        }
    }
</script>
