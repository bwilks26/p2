<?php

require('Form.php');

use DWA\Form;

$form = new Form($_GET);

$isSubmitted = $form->isSubmitted();

if ($isSubmitted) {
    // get form values from GET request
    $splitTerm = $form->get('splitTerm', $default = '5');
    $billAmount = $form->get('billAmount', $default = '10');
    $tipAmount = $form->get('tipAmount');
    $roundUp = $form->has('roundUp');

    // set our rules for form validation
    $errors = $form->validate(
        [
            'splitTerm' => 'required|numeric',
            'billAmount' => 'required|numeric'
        ]
    );

    // calculate correct result if form has no errors
    if (!$form->hasErrors) {
        if ($tipAmount) {
            $result = ($billAmount + ($billAmount * ($tipAmount / 100))) / $splitTerm;
        } else {
            $result = $billAmount / $splitTerm;
        }

        // round up by taking the ceiling of number if selected
        if ($roundUp) {
            $result = ceil($result);
        }

        // format result to be more user-friendly
        $result = number_format($result, 2, '.', ',');
    }
}


















