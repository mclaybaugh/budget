<?php

namespace App;

class TransactionRow {

  public $description;
  public $date;
  public $amount;
  public $edit_link;

  public function __construct(
    string $description,
    int $timestamp,
    float $amount,
    string $link) {

    $this->description = $description;
    $this->date = date('m-d', $timestamp);
    $this->amount = '$' . number_format($amount);
    $this->edit_link = $link;
  }

}