<?php

// Trait created using make:trait command

namespace App;

trait LoanHelper
{
    public function calc($principal, $rate,$term)
    {
        $frequency = 12;
        $rate /= 100;

        // formula to calculate amount: [P(1+(r/n))^(nt)]
        $amount = $principal * ((1 + ($rate / $frequency)) ** ($term));
        $interest = $amount - $principal;
        return json_decode(json_encode(['amount' => $amount, 'interest' => $interest]),false);
    }

    public function disbursement($loan){
        $charges=0;
        $amount_to_be_repaid=$loan->amount_approved-$loan->total_interest-$charges;

    }
}
