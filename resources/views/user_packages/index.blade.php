@extends('layouts.app')

@section('content')
    <div class="col-lg-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                My Packages
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td>Name</td>
                        <td>Amount (in Dollar $)</td>
                        <td>Actions</td>
                    </tr>
                    </thead>
                    <tbody>
                    @if (isset($packages) && !empty($packages))
                        @foreach($packages as $package)
                            <tr>
                                <td> {{ $package['name'] }} </td>
                                <td> ${{ $package['amount'] }} </td>
                                <td>
                                    @if ($package['joined'] === false)
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#upgradePackageModal">
                                            Activate VFS
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="upgradePackageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">VFS Upgrade Agreement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <p> <strong> DISCLAIMER ‼ </strong></p>

                    <p>
                        Money used to <strong> manually activate VFS </strong> <strong class="text-danger">ain't refundable</strong>.
                    </p>

                    <p>
                        Although you won't <strong>ever lose this money</strong> , but the automated system might not have generated surplus of it for you as at the time you may need it (especially, if you took a loan for it).
                    </p>

                    <p>
                        So, in as much as we are sure, you won't ever lose any dime you saved up with our Club,
                        <strong>
                            we ain't given guarantees on the time-frame the system can take before it generates surplus of profit on this VFS for you since everything is automated!
                        </strong>
                    </p>

                    <p>
                        So, if you are
                        <strong>
                            afraid to take risks, or impatient as to feel at home and allow the system work on your favor at it's time, PLEASE,
                            <strong class="text-danger"> DO NOT PROCESS ANY MANUAL ACTIVATION OF VFS IN TYEN CLUB. </strong>
                        </strong>
                        Just feel good with being a member (one of us),
                        <strong>
                            and allow the automated finance system use the club's money grow lifesavings for you at no risk. In less than 5years, we shall grow millions for you!
                        </strong>
                    </p>

                    <p>
                        <strong class="text-danger">
                            We refund only membership fee to any member who wishes to sign out of the club after 12months of loyalty, and if TYEN CLUB haven't provided any value, (either by cash or kind worth more than the membership fee to the said member) for all period of first 12months.
                        </strong>
                    </p>

                    Regards
                    <p>
                        <strong>
                            -TYEN CLUB TEAM
                        </strong>
                    </p>

                    <label for="tos_agreement">
                        <input id="tos_agreement" type="checkbox"> I agree
                    </label>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    @if(isset($package))
                    <form action="{{ route('user_packages:join_package', $package['id']) }}" method="POST">
                        @csrf
                        <input type="hidden" name="upgrade_agreement" value="1">
                        <button id="proceed" disabled type="submit" class="btn btn-primary"> Proceed</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#tos_agreement').change(function(event){
            if (event.target.checked == true) {
                jQuery('#proceed').prop('disabled', false);
            } else {
                jQuery('#proceed').prop('disabled', true);
            }
        });
    </script>
@endsection
