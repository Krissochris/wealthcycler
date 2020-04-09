@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> Rave Payment</div>

                    <div class="card-body">
                        <form>
                            <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
                            <button type="button" onClick="payWithRave()">Pay Now</button>
                        </form>
                        <script>
                            const API_publicKey = "<ADD YOUR PUBLIC KEY HERE>";

                            function payWithRave() {
                                var x = getpaidSetup({
                                    PBFPubKey: 'FLWPUBK-215f18d723c4669679a82d166839fdec-X',
                                    customer_email: "user@example.com",
                                    amount: 30,
                                    customer_phone: "234099940409",
                                    currency: "USD",
                                    txref: "rave-123456",
                                    meta: [{
                                        metaname: "flightID",
                                        metavalue: "AP1234"
                                    }],
                                    onclose: function() {},
                                    callback: function(response) {
                                        var txref = response.tx.txRef; // collect txRef returned and pass to a 					server page to complete status check.
                                        console.log("This is the response returned after a charge", response);
                                        if (
                                                response.tx.chargeResponseCode == "00" ||
                                                response.tx.chargeResponseCode == "0"
                                        ) {
                                            // redirect to a success page
                                        } else {
                                            // redirect to a failure page.
                                        }

                                        x.close(); // use this to close the modal immediately after payment.
                                    }
                                });
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection