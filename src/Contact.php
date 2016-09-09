<?php
    class Contact
    {
        private $name;
        private $number;
        private $address;

        function __construct($name, $number, $address)
        {
            $this->name = $name;
            $this->number = $number;
            $this->address = $address;
        }

        function setName($newName)
        {
            $this->name = (string) $newName;
        }

        function setNumber($newNumber)
        {
            $this->number = (string) $newNumber;
        }

        function setAddress($newAddress)
        {
            $this->address = (string) $newAddress;
        }

        function getName()
        {
            return $this->name;
        }

        function getNumber()
        {
            return $this->number;
        }

        function getAddress()
        {
            return $this->address;
        }
    }
?>
