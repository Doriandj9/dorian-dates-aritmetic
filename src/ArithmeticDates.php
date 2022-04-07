<?php

namespace Dates\Manejos;

use DateTime;
use Exception;

/**
 * Es una clase que maneja fechas de forma facil
 * 
 * Para usuarla hay dos parametros opcionales 
 * datetime que si no ingresa una fecha en formato string
 * y no ingresa nada regresa la fecha actual 
 * el segundo parametro es la zono horaria si no ingresa una 
 * zona horaria que soporte PHP se ejecutara con la zona horaria 
 * por defecto del servidor zonas horarias soportadas por PHP @link<https://www.php.net/manual/es/timezones.php>
 * revise su continente y luego escoga su continente y luego su cuidad y agreguelo como segundo argumento
 * o a partir de PHP 8 puede agregar ese unico argumento como zoneHoraria:"America/Guayaquil"
 * 
 * 
 * PHP version ^8.1
 * 
 * @author Dorian Armijos
 * @link <>
 * @category Dates
 * @return DateTime
 */

class ArithmeticDates extends \DateTime{
    /**
     * @var datetime 
     */
    private $datetime;
    private $day;
    private $hours;
    private $minute;
    private $seconds;
    private $microseconds;
    private $year;  
    private $mounth;
    /**
     *
     */
    public function __construct(string $datetime = 'now',string $zoneHoraria = null )
    {
        /**
         * Los siguientes if realizar la tarea de identificar que sea una fecha valida caso contrario regresa un Exception Error
         */
        if(strtolower($datetime) != 'now' && !preg_match("/^([0-9]{4}\b)-([0][1-9]{1}\b|[1][0-2]{1}\b)-([0][1-9]{1}\b|[1-2][0-9]{1}\b|[3][0-1]{1}\b)([0-1][0-9]{1}\b|[2][0-4]{1}\b:[0-5][0-9]{1}\b|60:[0-5][0-9]{1}\b|60)?/",$datetime)){
            throw new \Exception("Error no ingreso una fecha correcta");
        }
        $argumentsDate = preg_split("/\s/",$datetime);
        if( count($argumentsDate) > 1 && !preg_match("(([0-1][0-9]{1}\b|[2][0-4]{1}\b):([0-5][0-9]{1}\b|60):([0-5][0-9]{1}\b|60))",$argumentsDate[1])){
            throw new \Exception("Error ingreso la fecha se encuentra correctamente pero no la hora corrigalo para seguir");
        }
        /**
         * Verifica que tenga agregada una zona horaria
         */
        if($zoneHoraria){
                date_default_timezone_set($zoneHoraria);
        }
        
       $this->datetime= new \DateTime($datetime);
       parent::__construct($this->datetime->format('Y-m-d H:i:s'));
        $this->day          = $this->datetime->format('d');
        $this->hours        = $this->datetime->format('H');
        $this->minute       = $this->datetime->format('i');
        $this->seconds      = $this->datetime->format('s');
        $this->microseconds = $this->datetime->format('u');
        $this->year         = $this->datetime->format('Y');
        $this->mounth       = $this->datetime->format('m');
    }
    /**
     * Este metodo permite aumentar los meses de la fecha actual
     * 
     * @param int $numberMoth Es un entero que aumenta a la fecha actual el numero de meses  este valor no puede ser > 12 o < 0 
     */
    public function setMoth(int $numberMoth):void
    {
        if($numberMoth > 12){
            throw new Exception('Desborda el numero de meses permitidos si quiere aumentar años use el metodo setYear()');
        }
        if($numberMoth < 0){
            throw new Exception('Error no se puede aumentar meses negativos');
        }
     
        $mounthChange = intval($this->mounth,10);
        $calculo= $mounthChange + $numberMoth;
        $moreYear = $this->year;
        $moreMounth = $calculo;
        if($calculo > 12){
            $this->setYear(1);
            $moreYear = $this->year;
            $moreMounth = $calculo - 12;
                      
        }
        if($moreMounth < 10){
            $moreMounth = "0" . $moreMounth; 
        }
        $formatDate = $moreYear . '-' . $moreMounth . '-' . $this->day . ' ' . $this->hours . ':' . $this->minute . ':' . $this->seconds . '.' . $this->microseconds;
        $this->year= $moreYear;
        $this->mounth= $moreMounth;
        $this->datetime = new \DateTime($formatDate);
    }

    /**
     * Este metodo permite aumentar los años a la fecha actual 
     * 
     * @param int $year aumenta en años la fecha actual
     * @return void
     */

    public function setYear(int $year){
        if($year < 0){
            throw new Exception('Error no se puede aumentar años negativos verifique y continue');
        }
        $this->year = intval($this->year,10) + $year;
        $formatDate = $this->year . '-' . $this->mounth . '-' . $this->day . ' ' . $this->hours . ':' . $this->minute . ':' . $this->seconds . '.' . $this->microseconds;
        $this->datetime= new \DateTime($formatDate);
    }

    /**
     * Este metodo sirve para aumentar los dias de la fecha
     * 
     * @param int $day Son los dias que puede aumentar a la fecha este valor no puede ser > 31 o < 0
     * @return void
     */

    public function setDay(int $day):void
    {
        if($day > 31 || $day < 0){
            throw new Exception('Error el valor no puede ser mayor a 31 o menor a 0 verifique y continue');
        }
        $numberDays = $this->getMothDay($this->mounth);
        $daysCalculo = intval($this->day) + $day;
        $moreDays = $daysCalculo;
        $moreMounth = $this->mounth;
        if($daysCalculo > $numberDays){
            $this->setMoth(1);
            $moreMounth = $this->mounth;
            $daysmorMount = $this->getMothDay($moreMounth);
            if($daysCalculo > $daysmorMount){
                $this->setMoth(1);
                $moreMounth =$this->mounth;
                $moreDays = $daysCalculo - $daysmorMount;
            }
            $moreDays = $daysmorMount - $daysCalculo;
        }

        if($moreDays < 10){
            $moreDays = '0' . $moreDays;
        }

        $formatDate = $this->year . '-' . $moreMounth . '-' . $moreDays . ' ' . $this->hours . ':' . $this->minute . ':' . $this->seconds . '.' . $this->microseconds;
        $this->datetime = new \DateTime($formatDate);
        $this->mounth = $moreMounth;
        $this->day = $moreDays;
    }


    /**
     * Este metodo permite aumenta a la fecha las horas los minutos y los segundos 
     * 
     * @param int $hours Son las horas que se aumneta a la fecha el valor no puede ser > 24 y < 0
     * @param int $minutes Son los minutos que se aumenta a la fecha el valor no puede ser > 60 y < 0
     * @param int $seconds Son los segundos que se aumenta a la fecha el valor no puede ser > 60 y < 0 y si no ingresa un valor los segundos se colocan en 00
     * @return void
     */
    public function setHourMinutesSeconds(int $hours, int $minutes, int $seconds=00): void
    {
        if($hours > 24 || $hours < 0){
            throw new Exception('Error las horas no deben sobrepasar el valor de 24 que es un dia o menor a 0 verifique y vuelva a intertalo');
        }
        if($minutes > 60 || $minutes < 0){
            throw new Exception('Error los minitos no deben sobrepasar los 60 que es una hora o ser menores a 0 verifique y vuelva a intentarlo');
        }
        if($seconds > 60 || $seconds < 0){
            throw new Exception('Error los segundos no deben sobrepasar los 60 que es un minito o ser menores a 0 verifique y vuelva a intentarlo');
        }

        $hoursCalculo = intval($this->hours) + $hours;
        $minutesCalculo = intval($this->minute) + $minutes;
        $secondsCalculo = $seconds;
        if($seconds > 0){
            $secondsCalculo = intval($this->seconds) + $seconds;
        }
        /**
         * Calculamos las horas 
         * Calculamos los minitos 
         * Calculamos los segundos
         */
        $moreHours = $hoursCalculo;
        $moreMinites = $minutesCalculo;
        $moreSeconds = $secondsCalculo;

        if($secondsCalculo > 60){
            $minutesCalculo += 1;
            $moreSeconds = $secondsCalculo - 60;
        }
        if($moreSeconds < 9){
            $moreSeconds = '0' . $moreSeconds;
        }

        if($minutesCalculo > 60){
            $hoursCalculo += 1;
            $moreMinites = $minutesCalculo - 60;
            if($moreMinites < 9){
                $moreMinites = '0' . $moreMinites;
            }
        }

        $moreDays = $this->day;
        if($hoursCalculo > 24){
            $this->setDay(1);
            $moreDays = $this->day;
            $moreHours = $hoursCalculo - 24;
            if($moreHours < 9){
                $moreHours = "0". $moreHours;
            }
        }

        if(intval($moreMinites) == 60 && intval($moreSeconds) == 00){
            $moreMinites = "59";
            $moreSeconds = "60";
        }

        $formatDate = $this->year . '-' . $this->mounth . '-' . $moreDays . ' ' . $moreHours . ':'  . $moreMinites . ':' . $moreSeconds;
        $this->datetime = new \DateTime($formatDate);
        $this->day= $moreDays;
        $this->hours= $moreHours;
        $this->minute= $moreMinites;
        $this->seconds= $moreSeconds;
     
    }

    /**
     * Permite encontrar cuantos dias tiene el mes a umentar
     * 
     * @param string $indexMounth Es el indece del mes que regresa el numero de dias que tiene
     * @return int
     */
    private function getMothDay(string $indexMounth):int
    {
        $mounthDays = [31,28,31,30,31,30,31,31,30,31,30,31];
        if($this->leapYear()){
            $mounthDays = [31,29,31,30,31,30,31,31,30,31,30,31];
        }

        return $mounthDays[intval($indexMounth)-1];
        
    }
    /**
     * Metodo para saber si una año es bisiesto y es febrero
     * 
     * @return bool
     */

    private function leapYear():bool
    {
        return date('L',strtotime($this->datetime->format('Y-m-d'))) &&  intval($this->mounth) == 2 ;
    }
    /**
     * Esta funcion regresa el resultado final de haber aplicado los metodos de aumentar años, meses , dias , horas ,minutos  y segundos
     * 
     *  @return DateTime|ArithmeticDates
     */
    public function getResult(): DateTime|ArithmeticDates
    {
        return $this->datetime;
    }

    /**
     * Este metodo estatico permite verificar si una fecha en especifo se encentra dentro de un rango de fechas 
     * 
     * @param DateTime|ArithmeticDates $start Es el intervalo inicial
     * @param DateTime|ArithmeticDates $end Es el intervalo final 
     * @param DateTime|ArithmeticDates $date Es la fecha a comprobar si se encuentra en ese intervalo de $start a $end
     * @return bool
     */

    public static function hasInterval( DateTime|ArithmeticDates $start , DateTime|ArithmeticDates $end, DateTime | ArithmeticDates $date):bool
    {
        $startInterval = $start->getTimestamp();
        $endInterval = $end->getTimestamp();

        return $date->getTimestamp() >= $startInterval && $date->getTimestamp() <= $endInterval;

    }
}


