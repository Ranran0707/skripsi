<div>
    <style>
        nav svg {
            height: 20px;
        }

        nav .hidden {
            display: block !important;
        }
    </style>
    <div class="container" style="padding: 30px 0">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        All Orders
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Subtotal</th>
                                        <th>Discount</th>
                                        {{-- <th>Tax</th> --}}
                                        <th>Total</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        {{-- <th>Mobile</th> --}}
                                        <th>Email</th>
                                        {{-- <th>Zipcode</th> --}}
                                        <th>Status</th>
                                        <th>Order Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ Str::rupiah($order->subtotal) }}</td>
                                            <td>{{ Str::rupiah($order->discount) }}</td>
                                            {{-- <td>Rp : {{ $order->tax }}</td> --}}
                                            <td>{{ Str::rupiah($order->total + $order->cost) }}</td>
                                            <td>{{ $order->firstname }}</td>
                                            <td>{{ $order->lastname }}</td>
                                            {{-- <td>{{ $order->mobile }}</td> --}}
                                            <td>{{ $order->email }}</td>
                                            {{-- <td>{{ $order->zipcode }}</td> --}}
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
                                            <td>
                                                @if ($order->status = 'ordered')
                                                    <a href="{{ route('user.payment', ['order_id' => $order->id]) }}"
                                                        class="btn btn-success btn-sm">Payment</a>
                                                @endif
                                                <a href="{{ route('user.orderdetails', ['order_id' => $order->id]) }}"
                                                    class="btn btn-info btn-sm">Details</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
