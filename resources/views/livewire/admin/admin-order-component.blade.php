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
                        @if (Session::has('order_message'))
                            <div class="alert alert-success" role="alert">{{ Session::get('order_message') }}</div>
                        @endif
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
                                        <th colspan="2" class="text-center">Action</th>
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
                                            <td><a href="{{ route('admin.orderdetails', ['order_id' => $order->id]) }}"
                                                    class="btn btn-info btn-sm">Details</a>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success btn-sm dropdown-toggle" type="button"
                                                        data-toggle="dropdown">Status
                                                        <span class="caret"></span></button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#"
                                                                wire:click.prevent="updateOrderStatus({{ $order->id }},'delivered')">Delivered</a>
                                                        </li>
                                                        <li><a href="#"
                                                                wire:click.prevent="updateOrderStatus({{ $order->id }},'canceled')">Canceled</a>
                                                        </li>
                                                        <li><a href="#"
                                                                wire:click.prevent="updateOrderStatus({{ $order->id }},'approved')">Approved</a>
                                                        </li>
                                                        <li><a href="#"
                                                                wire:click.prevent="updateOrderStatus({{ $order->id }},'pending')">Pending</a>
                                                        </li>
                                                    </ul>
                                                </div>
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
