<?php

require ('Form.php');

use DWA\Form;

$form = new Form($_GET);

//$splitTerm = (has($form->get('splitTerm'))) ? $form->get('splitTerm') : '';
$splitTerm = $form->get('splitTerm', $default = '5');
$billAmount = $form->get('billAmount', $default = '10');
$tipAmount = $form->get('tipAmount');
$roundUp = $form->has('roundUp');

$isSubmitted = $form->isSubmitted();


if ($isSubmitted) {
    $errors = $form->validate(
        [
            'splitTerm' => 'required|numeric',
            'billAmount' => 'required|numeric'
        ]
    );

    if (!$form->hasErrors) {
        if($tipAmount) {
            $result = ($billAmount + ($billAmount * ($tipAmount / 100))) / $splitTerm;
        }
        else {
            $result = $billAmount / $splitTerm;
        }

        if ($roundUp) {
            $result = ceil($result);
        }

        $result = number_format($result, 2, '.', ',');
    }
}


















