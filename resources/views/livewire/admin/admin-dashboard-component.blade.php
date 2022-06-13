<div class="content">
    <style>
        .content {
            padding-top: 40px;
            padding-bottom: 40px;
        }

        .icon-stat {
            display: block;
            overflow: hidden;
            position: relative;
            padding: 15px;
            margin-bottom: 1em;
            background-color: #fff;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        .icon-stat-label {
            display: block;
            color: #999;
            font-size: 13px;
        }

        .icon-stat-value {
            display: block;
            font-size: 28px;
            font-weight: 600;
        }

        .icon-stat-visual {
            position: relative;
            top: 22px;
            display: inline-block;
            width: 32px;
            height: 32px;
            border-radius: 4px;
            text-align: center;
            font-size: 16px;
            line-height: 30px;
        }

        .bg-primary {
            color: #fff;
            background: #d74b4b;
        }

        .bg-secondary {
            color: #fff;
            background: #6685a4;
        }

        .icon-stat-footer {
            padding: 10px 0 0;
            margin-top: 10px;
            color: #aaa;
            font-size: 12px;
            border-top: 1px solid #eee;
        }
    </style>
    <div class="container">
        <div class="row" style="padding-bottom: 30px ">
            <h1 class="page-header">Welcome to Dashboard, <b>{{ Auth::user()->name }}</b></h1>
        </div>
        {{-- <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="icon-stat">
                    <div class="row">
                        <div class="col-xs-8 text-left">
                            <span class="icon-stat-label">Total Revenue</span>
                            <span class="icon-stat-value">${{ $totalRevenue }}</span>
                        </div>
                        <div class="col-xs-4 text-center">
                            <i class="fa fa-dollar icon-stat-visual bg-primary"></i>
                        </div>
                    </div>
                    <div class="icon-stat-footer">
                        <i class="fa fa-clock-o"></i> Updated Now
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="icon-stat">
                    <div class="row">
                        <div class="col-xs-8 text-left">
                            <span class="icon-stat-label">Total Sales</span>
                            <span class="icon-stat-value">{{ $totalSales }}</span>
                        </div>
                        <div class="col-xs-4 text-center">
                            <i class="fa fa-gift icon-stat-visual bg-secondary"></i>
                        </div>
                    </div>
                    <div class="icon-stat-footer">
                        <i class="fa fa-clock-o"></i> Updated Now
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="icon-stat">
                    <div class="row">
                        <div class="col-xs-8 text-left">
                            <span class="icon-stat-label">Today Revenue</span>
                            <span class="icon-stat-value">${{ $todayRevenue }}</span>
                        </div>
                        <div class="col-xs-4 text-center">
                            <i class="fa fa-dollar icon-stat-visual bg-primary"></i>
                        </div>
                    </div>
                    <div class="icon-stat-footer">
                        <i class="fa fa-clock-o"></i> Updated Now
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="icon-stat">
                    <div class="row">
                        <div class="col-xs-8 text-left">
                            <span class="icon-stat-label">Today Sales</span>
                            <span class="icon-stat-value">{{ $todaySales }}</span>
                        </div>
                        <div class="col-xs-4 text-center">
                            <i class="fa fa-gift icon-stat-visual bg-secondary"></i>
                        </div>
                    </div>
                    <div class="icon-stat-footer">
                        <i class="fa fa-clock-o"></i> Updated Now
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Latest Order
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>OrderId</th>
                                        <th>Subtotal</th>
                                        <th>Discount</th>
                                        <th>Shipping</th>
                                        <th>Total</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Order Date</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ Str::rupiah($order->subtotal) }}</td>
                                            <td>{{ Str::rupiah($order->discount) }}</td>
                                            <td>{{ Str::rupiah($order->cost) }}</td>
                                            <td>{{ Str::rupiah($order->total + $order->cost) }}</td>
                                            <td>{{ $order->firstname }}</td>
                                            <td>{{ $order->lastname }}</td>
                                            <td>{{ $order->email }}</td>
                                            @if ($order->status == 'ordered')
                                                <td class="label label-default" style="line-height: 4">
                                                    {{ $order->status }}
                                                </td>
                                            @elseif ($order->status == 'pending')
                                                <td class="label label-warning" style="line-height: 4">
                                                    {{ $order->status }}
                                                </td>
                                            @elseif ($order->status == 'canceled')
                                                <td class="label label-danger" style="line-height: 4">
                                                    {{ $order->status }}
                                                </td>
                                            @elseif ($order->status == 'approved')
                                                <td class="label label-success" style="line-height: 4">
                                                    {{ $order->status }}
                                                </td>
                                            @elseif ($order->status == 'delivered')
                                                <td class="label label-primary" style="line-height: 4">
                                                    {{ $order->status }}
                                                </td>
                                            @endif
                                            <td>{{ $order->created_at }}</td>
                                            <td><a href="{{ route('admin.orderdetails', ['order_id' => $order->id]) }}"
                                                    class="btn btn-info btn-sm">Details</a>
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
