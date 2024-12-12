<?php

abstract class Users {

    public function __construct($name, $email, $phone, $address, $joinDate) {

        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
        $this->joinDate = $joinDate;
    }

}