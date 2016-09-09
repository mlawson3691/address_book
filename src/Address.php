<?php
    class Address
    {
        private $street;
        private $city;
        private $state;
        private $zip;

        function __construct($street, $city, $state, $zip)
        {
            $this->street = ucwords($street);
            $this->city = ucwords($city);
            $this->state = strtoupper($state);
            $this->zip = $zip;
        }

        function setStreet($newStreet)
        {
            $this->street = (string) ucwords($newStreet);
        }

        function setCity($newCity)
        {
            $this->city = (string) ucwords($newCity);
        }

        function setState($newState)
        {
            $this->state = (string) strtoupper($newState);
        }

        function setZip($newZip)
        {
            $this->zip = (int) $newZip;
        }

        function getStreet()
        {
            return $this->street;
        }

        function getCity()
        {
            return $this->city;
        }

        function getState()
        {
            return $this->state;
        }

        function getZip()
        {
            return $this->zip;
        }
    }
?>
