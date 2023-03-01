@extends('admin_login.index')
@section('tittle', 'Customer')
@section('customer_selected', 'active')
@section('content')
<h1>Customer Details</h1>
<div class="col-md-12 mt-5">
    <a href="{{url('customer')}}" class="btn btn-primary mb-3"><- Back</a>
    <!-- DATA TABLE-->
    <div class="table-responsive m-b-40">
        <table class="table table-borderless table-data3">
            <thead>
                <tr>
                   <th>Field</th>
                   <th class="text-left">Value</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-left"><strong>Name</strong></td>
                    <td class="text-left">{{$customer_list->name}}</td>
                </tr>
                <tr>
                    <td class="text-left"><strong>Email</strong></td>
                    <td class="text-left">{{$customer_list->email}}</td>
                </tr>
                <tr>
                    <td class="text-left"><strong>Mobile</strong></td>
                    <td class="text-left">{{$customer_list->mobile}}</td>
                </tr>
                <tr>
                    <td class="text-left"><strong>Password</strong></td>
                    <td class="text-left">{{$customer_list->password}}</td>
                </tr>
                <tr>
                    <td class="text-left"><strong>Address</strong></td>
                    <td class="text-left">{{$customer_list->address}}</td>
                </tr>
                <tr>
                    <td class="text-left"><strong>City</strong></td>
                    <td class="text-left">{{$customer_list->city}}</td>
                </tr>
                <tr>
                    <td class="text-left"><strong>State</strong></td>
                    <td class="text-left">{{$customer_list->state}}</td>
                </tr>
                <tr>
                    <td class="text-left"><strong>Zip</strong></td>
                    <td class="text-left">{{$customer_list->zip}}</td>
                </tr>
                <tr>
                    <td class="text-left"><strong>Company</strong></td>
                    <td class="text-left">{{$customer_list->company}}</td>
                </tr>
                <tr>
                    <td class="text-left"><strong>gstin</strong></td>
                    <td class="text-left">{{$customer_list->gstin}}</td>
                </tr>
                <tr>
                    <td class="text-left"><strong>Created At</strong></td>
                    <td class="text-left">{{($customer_list->created_at)->format('d-m-Y  h:m:s')}}</td>
                </tr>
                <tr>
                    <td class="text-left"><strong>Updated At</strong></td>
                    <td class="text-left">{{($customer_list->updated_at)->format('d-m-Y  h:m:s')}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- END DATA TABLE-->
</div>
@stop