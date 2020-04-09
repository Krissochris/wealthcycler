@extends("layouts.app")

@section("title")
  Make Transfer
@stop

@section("content")
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4> Make a transfer </h4>
            </div>
            <div class="card-body">
                <div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5">
                            <div class="card">
                                <div class="card-body">
                                    <div class="stat-widget-one">
                                        <div class="stat-content dib">
                                            <div class="stat-text text-danger" id="from_label">Savings Wallet</div>
                                            <div class="stat-digit"><span>&#36;</span> <span id="from_wallet_amount"> {{ $saving_wallet_amount }} </span>    </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-2 col-xs-2 text-justify">
                            <p class="text-center"> <i id="transfer_icon" class="text-success fa fa-arrow-right fa-2x"> </i> </p>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-5">
                            <div class="card">
                                <div class="card-body">
                                    <div class="stat-widget-one">
                                        <div class="stat-content dib">
                                            <div class="stat-text text-success" id="to_label">Virtual Wallet</div>
                                            <div class="stat-digit"><span>&#36;</span> <span id="to_wallet_amount">  {{ $virtual_wallet_amount }} </span>   </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {!! Form::open(['route' => 'transfer:process', 'id' => 'transfer_form']) !!}
                <div class="row">
                    <div class="col-sm-6">
                        {!! Form::label('from_wallet', 'From Wallet') !!}
                        {!! Form::select('from_wallet', ['saving' => 'Savings Wallet', 'virtual' => 'Virtual Wallet'], null, [
                        'class' => 'form-control',
                        'id' => 'from_wallet'
                        ]) !!}

                    </div>

                    <div class="col-sm-6">
                        {!! Form::label('to_wallet', 'To Wallet') !!}
                        {!! Form::select('to_wallet', ['virtual' => 'Virtual Wallet', 'saving' => 'Savings Wallet'], null, [
                        'class' => 'form-control',
                        'id' => 'to_wallet'
                        ]) !!}
                    </div>

                </div>

                <div class="form-group">
                    {!! Form::label('amount', 'Amount') !!}
                    {!! Form::number('amount', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Submit',['class'=> 'btn btn-primary', 'id' => 'commit_transfer']) !!}
                </div>

                {!! Form::close() !!}

            </div>

        </div>
    </div>

    <div class="modal fade" id="virtual_transfer_modal" tabindex="-1" role="dialog" aria-labelledby="virtual_transfer_modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Virtual Transfer </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-danger">NOTE:</p>
                    <p>
                        To transfer from your virtual wallet to the saving, the system required you have up to <strong>  50 active referrals from your last
                            virtual transfer time to this day </strong>. Else <strong> 10%  </strong> of your transfer amount will be taken by the system as <strong> club's service charge </strong> and
                        only <strong>90%</strong> of the specified amount will be credited to your saving wallet.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel Transfer</button>
                    <button id="proceed_with_transfer" type="button" class="btn btn-success"> Proceed </button>

                </div>
            </div>
        </div>
    </div>


    <script>

        (function ($) {
            var template = {
                from_label : $('#from_label'),
                to_label : $('#to_label'),
                from_wallet_amount : $('#from_wallet_amount'),
                to_wallet_amount : $('#to_wallet_amount'),
            };

            var inputs = {
                from_wallet: 'saving',
                to_wallet: 'virtual',
                override_transfer_limit: false

            };

            var wallets = {
                saving : {
                    label: 'Savings Wallet',
                    amount : {{ $saving_wallet_amount }}
                },
                virtual : {
                    label: 'Virtual Wallet',
                    amount : {{ $virtual_wallet_amount }}
                }
            };

            $("#from_wallet").change(function(event) {
                var value = event.target.value;
                if (value) {
                    inputs.from_wallet = value;
                    template.from_label.text(wallets[value].label);
                    template.from_wallet_amount.text(wallets[value].amount);
                    if (inputs.from_wallet == inputs.to_wallet) {
                        $("#transfer_icon").removeClass("text-success fa-arrow-right");
                        $("#transfer_icon").addClass("text-danger fa-close")
                    } else {
                        $("#transfer_icon").addClass("text-success fa-arrow-right");
                        $("#transfer_icon").removeClass("text-danger fa-close")
                    }
                }
            });

            $("#to_wallet").change(function(event) {
               var value = event.target.value;
               if (value) {
                   inputs.to_wallet = value;
                   template.to_label.text(wallets[value].label);
                   template.to_wallet_amount.text(wallets[value].amount);
                   if (inputs.from_wallet == inputs.to_wallet) {
                       $("#transfer_icon").removeClass("text-success fa-arrow-right");
                       $("#transfer_icon").addClass("text-danger fa-close")
                   } else {
                       $("#transfer_icon").addClass("text-success fa-arrow-right");
                       $("#transfer_icon").removeClass("text-danger fa-close")
                   }
               }
            });

            $("#commit_transfer").click(function(event){
                event.preventDefault();
                if (inputs.from_wallet === "saving") {
                    $("#transfer_form").submit();
                } else if (inputs.from_wallet === "virtual") {

                    if (inputs.override_transfer_limit) {
                        $("#transfer_form").submit();
                    } else {
                        $('#virtual_transfer_modal').modal({
                            backdrop: 'static',

                        })

                    }
                    // if the user has override ?
                    // submit the request
                }
            });

            $("#proceed_with_transfer").click(function(event){
                $("#transfer_form").submit();
            })

        })(jQuery)
    </script>

@endsection
