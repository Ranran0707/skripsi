<div class="container">
    <div class="row justify-content-center " style="margin-top: 50px;margin-bottom:50px">
        <div class="my-5 pt-5">
            @if ($belanja->status == 'ordered')
                {{-- <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary center-block" id="pay-button">Pay!</button>
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading ">
                                <div class="row">
                                    <div class="col-md-6">
                                        Ordered Details
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-success pull-right" id="pay-button">PAYMENT!</button>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="wrap-iten-in-cart">
                                    <h3 class="box-title">Products Name</h3>
                                    <ul class="products-cart">
                                        @foreach ($order->orderItems as $item)
                                            <li class="pr-cart-item">
                                                <div class="product-image">
                                                    <figure><img
                                                            src="{{ asset('assets/images/products') }}/{{ $item->product->image }}"
                                                            alt="{{ $item->product->name }}">
                                                    </figure>
                                                </div>
                                                <div class="product-name">
                                                    <a class="link-to-product"
                                                        href="{{ route('product.details', ['slug' => $item->product->slug]) }}">{{ $item->product->name }}</a>
                                                </div>

                                                @if ($item->options)
                                                    <div class="product-name">
                                                        @foreach (unserialize($item->options) as $key => $value)
                                                            <p><b>{{ $key }}: {{ $value }}</b></p>
                                                        @endforeach
                                                    </div>
                                                @endif

                                                <div class="price-field produtc-price">
                                                    <p class="price">{{ Str::rupiah($item->price) }}</p>
                                                </div>
                                                <div class="quantity">
                                                    <h5>Quantity : {{ $item->quantity }}</h5>
                                                </div>
                                                <div class="price-field sub-total">
                                                    <p class="price">
                                                        {{ Str::rupiah($item->price * $item->quantity) }}</p>
                                                </div>
                                                @if ($order->status == 'delivered' && $item->rstatus == false)
                                                    <div class="price-field sub-total">
                                                        <p class="price"><a
                                                                href="{{ route('user.review', ['order_item_id' => $item->id]) }}">Write
                                                                Review</a></p>
                                                    </div>
                                                @endif

                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="summary">
                                    <div class="order-summary">
                                        <h4 class="title-box">Order Summary</h4>
                                        <p class="summary-info"><span class="title">Subtotal</span><b
                                                class="index">{{ Str::rupiah($order->subtotal) }}</b></p>
                                        {{-- <p class="summary-info"><span class="title">Tax</span><b
                                                class="index">Rp : {{ $order->tax }}</b></p> --}}
                                        <p class="summary-info"><span class="title">Shipping</span><b
                                                class="index">{{ Str::rupiah($order->cost) }}</b></p>
                                        <p class="summary-info"><span class="title">Total</span><b
                                                class="index">{{ Str::rupiah($order->total + $order->cost) }}
                                            </b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif ($belanja->status == 'pending' || $belanja->status == 'approved')
                <div class="panel panel-default ">
                    <div class="panel-heading ">
                        <div class="row">
                            <div class="col-md-6">
                                Ordered Details
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('user.orders') }}" class="btn btn-success pull-right">My Orders</a>

                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <td>Virtual Akun</td>
                                <td></td>
                                <td>{{ $va_number }}</td>
                            </tr>
                            <tr>
                                <td>Mode Pembayaran</td>
                                <td></td>
                                <td>{{ $bank }}</td>
                            </tr>
                            <tr>
                                <td>Total Harga</td>
                                <td></td>
                                <td>{{ Str::rupiah($gross_amount) }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td></td>
                                <td>{{ $transaction_status }}</td>
                            </tr>
                            <tr>
                                <td>Batas Waktu Pembayaran</td>
                                <td></td>
                                <td>{{ $deadline }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

            @endif
        </div>
    </div>
</div>

<div>
    <form method="get" action="Payment" id="payment-form">
        <input type="hidden" id="result-data" name="result_data" value="">
</div>
</form>


<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
data-client-key="SB-Mid-client-NI9wsutnuosldlV-"></script>

<script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function() {

        var resultType = document.getElementById('result-type');
        var resultData = document.getElementById('result-data');
        console.log('TYPE', resultType);

        console.log('DATA', resultData);

        function changeResult(type, data) {
            $("#result-type").val(type);
            $("#result-data").val(JSON.stringify(data));
            console.log('COBA', type, data);
            //resultType.innerHTML = type;
            //resultData.innerHTML = JSON.stringify(data);
        }


        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        window.snap.pay('<?= $snapToken ?>', {
            onSuccess: function(result) {
                /* You may add your own implementation here */
                alert("payment success!");
                console.log('SuccesEX', result);
                $("#payment-form").submit();
            },
            onPending: function(result) {
                /* You may add your own implementation here */
                alert("wating your payment!");
                console.log('WaitEX', result);
                changeResult('text', result);
                $("#payment-form").submit();
                console.log('DATA', resultData);

            },
            onError: function(result) {
                /* You may add your own implementation here */
                alert("payment failed!");
                console.log('FailedEX', result);
                $("#payment-form").submit();

            },
            onClose: function() {
                /* You may add your own implementation here */
                alert('you closed the popup without finishing the payment');
            }
        })
    });
</script>
