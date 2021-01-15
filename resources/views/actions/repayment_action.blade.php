<div class='btn-group'>
    @if(($penalty+($amount_default*-1)+$amount)>$amount_paid)
        <a href="#" onclick="makeRepayment({{$id}})" class="btn btn-success"><i>Add Payment</i></a>
    @endif
</div>

