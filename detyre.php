<?php

abstract class Person {
    protected $ime;
    protected $prezime;
    protected $datum_rodjenja;
    protected $email;
    protected $pol;

    public function __construct($ime, $prezime, $datum_rodjenja, $email, $pol) {
        $this->ime = $ime;
        $this->prezime = $prezime;
        $this->datum_rodjenja = $datum_rodjenja;
        $this->email = $email;
        $this->pol = $pol;
    }

    public function get() {
        return [
            'Ime' => $this->ime,
            'Prezime' => $this->prezime,
            'Datum rođenja' => $this->datum_rodjenja,
            'Email' => $this->email,
            'Pol' => $this->pol
        ];
    }

    public function set($atributi) {
        $this->ime = $atributi['Ime'] ?? $this->ime;
        $this->prezime = $atributi['Prezime'] ?? $this->prezime;
        $this->datum_rodjenja = $atributi['Datum rođenja'] ?? $this->datum_rodjenja;
        $this->email = $atributi['Email'] ?? $this->email;
        $this->pol = $atributi['Pol'] ?? $this->pol;
    }

    abstract public function scheduleWork();
}

class Professor extends Person {
    protected $akademska_titula;

    public function __construct($ime, $prezime, $datum_rodjenja, $email, $pol, $akademska_titula) {
        parent::__construct($ime, $prezime, $datum_rodjenja, $email, $pol);
        $this->akademska_titula = $akademska_titula;
    }

    public function get() {
        $atributi = parent::get();
        $atributi['Akademska titula'] = $this->akademska_titula;
        return $atributi;
    }

    public function set($atributi) {
        parent::set($atributi);
        $this->akademska_titula = $atributi['Akademska titula'] ?? $this->akademska_titula;
    }

    public function scheduleWork() {
        return "Full radno vrijeme";
    }
}

interface StudentInterface {
    public function registerSemester();
    public function assignGroup();
}

class Student extends Person implements StudentInterface {
    protected $akademska_godina;
    protected $nivo_studija;
    protected $odsjek;

    public function __construct($ime, $prezime, $datum_rodjenja, $email, $pol, $akademska_godina, $nivo_studija, $odsjek) {
        parent::__construct($ime, $prezime, $datum_rodjenja, $email, $pol);
        $this->akademska_godina = $akademska_godina;
        $this->nivo_studija = $nivo_studija;
        $this->odsjek = $odsjek;
    }

    public function get() {
        $atributi = parent::get();
        $atributi['Akademska godina'] = $this->akademska_godina;
        $atributi['Nivo studija'] = $this->nivo_studija;
        $atributi['Odsjek'] = $this->odsjek;
        return $atributi;
    }

    public function set($atributi) {
        parent::set($atributi);
        $this->akademska_godina = $atributi['Akademska godina'] ?? $this->akademska_godina;
        $this->nivo_studija = $atributi['Nivo studija'] ?? $this->nivo_studija;
        $this->odsjek = $atributi['Odsjek'] ?? $this->odsjek;
    }

    public function registerSemester() {
        return "Semestar uspješno upisan";
    }

    public function assignGroup() {
        return "Grupa uspješno dodijeljena";
    }
}

// Primjer korištenja
$profesor = new Professor("John", "Doe", "01-01-1980", "john.doe@email.com", "Muški", "Doktor znanosti");
print_r($profesor->get());
echo $profesor->scheduleWork() . "\n";

$student = new Student("Jane", "Doe", "15-05-1995", "jane.doe@email.com", "Ženski", "2. godina", "Bachelor", "Informatika");
print_r($student->get());
echo $student->registerSemester() . "\n";
echo $student->assignGroup() . "\n";

?>
