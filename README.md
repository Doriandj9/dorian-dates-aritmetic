# Aritmetica con Fechas
Es un una libreria pequeña que permite el manejo de fechas de forma facil
<p align="center">
<a href="https://scrutinizer-ci.com/g/Doriandj9/dorian-dates-aritmetic/?branch=master"><img src="https://scrutinizer-ci.com/g/Doriandj9/dorian-dates-aritmetic/badges/quality-score.png?b=master" alt="Code Quality" /></a>
<a href="https://scrutinizer-ci.com/g/Doriandj9/dorian-dates-aritmetic/?branch=master"> <img src="https://scrutinizer-ci.com/g/Doriandj9/dorian-dates-aritmetic/badges/coverage.png?b=master" alt="Code Coverage" /> </a>
</p>

## Instalación
```bash
composer require dorian-dates/aritmetic
```
## Introducción
La libreria basica de ArithmeticDates usa como base la clase DateTime de php el primer argumnero es la fecha que se desea representar debe ser un string y el segundo parametro es la zona horaria sin embargo las dos opciones son opcionales si no ingresa ninguna de las opciones la clase genera un objeto con la fecha actual y la zona horaria por defecto del servidor 

## Uso simple
### Uso en php veriones 7.4 
```php
    use Dates\Manejos\ArithmeticDates;
    $date = new ArithmeticDates('now', 'America/Guayaquil');
```
- En esta version si se desea implementar una zona horaria en especifico tiene que enviar el primer parametro obligatoriamente como now si se desea la fecha actual y el segundo parametro la zona horaria
### Uso en php ^8.0
```php
    use Dates\Manejos\ArithmeticDates;
    $date = new ArithmeticDates(zoneHoraria:'America/Guayaquil');
```
- A partir de php 8.0 puede informar metodos de una clases que parametros va a enviar y por lo tanto no es nesesario ingresar el primer parametro para generar una un objeto de con la fecha actual

## Metodos de la clase ArithmeticDates

```php
// Es el metodo que sirve para aumentar años a la fecha instanciada anteriormente
// El valor que se debe de ingresar no debe ser menor a 0  
$date->setYear(1)
// Es el metodo para aumentar meses 
// Este valor no debe ser menor a 0 y mayor a 12 que es un año 
$date->setMoth(3)
//Es el metodo para aumentar dias a la fecha
// Este valor no debe ser menor a 0 y mayor a 31 
$date->setDay(15) 
// Este metodo aumenta las horas , minutos y segundos a la fecha
// Estos valores en el cso de las horas no deben ser mayor a 24 y menores a 0
// En el caso de los minutos y segundos no deben ser mayor a 60 y menor a 0
// En este ejemplo aumentara 5 horas 20 minutos y 15 segundos
$date->setHourMinutesSeconds(5,20,15);
// Este metodo retorna el resultado de haber aplicado los metodos anteriores en como un DateTime
$resulArithmeticDate = $date->getResult();
// El resultado un nueva fecha modificada y con todos los metodos de DateTime
$resulArithmeticDate->getTimestamp(); // Devuelve el fecha en unidad UNIX en milisegundos propio de DateTime

/*Metodos Estaticos de la clase ArithmeticDates*/
//Este metodo estatico sirve para identificar si una fecha se encuentra dentro de un rango de fechas
// Recibe tres parametros el primero es la fecha minima del intervalo
//El segundo es la fecha maxima del intervalo 
//El tercero es la fecha que se va a identificar dentro de ese rango 
// La representacion matematica es [a,b] = {fechaA <= fecha <= fechaB}
// Retorna true si se encuentra en ese rango y false si no 
$arithmeticDatesA = new ArithmeticDates('2022-02-15 00:00:00','America/Guayaquil');
$arithmeticDatesB = new ArithmeticDates('2022-05-01 00:00:00','America/Guayaquil');
$arithmeticDates = new ArithmeticDates('2022-04-09 00:00:00','America/Guayaquil');
ArithmeticDates::hasInterval($arithmeticDatesA,$arithmeticDatesB,$arithmeticDates) // true
```
- Tener en cuenta que los segundos afectan en el resultado de la respuesta que regresa hasInterval 
```php
$arithmeticDatesA = new ArithmeticDates('2022-02-15 12:30:40','America/Guayaquil');
$arithmeticDatesB = new ArithmeticDates('2022-05-01 12:30:45','America/Guayaquil');
$arithmeticDates = new ArithmeticDates('2022-05-01 12:30:50','America/Guayaquil');
ArithmeticDates::hasInterval($arithmeticDatesA,$arithmeticDatesB,$arithmeticDates) // false
```
- Retorna false ya que los segundos son mayores que el arithmeticDatesB

- El orden en que se aplique los metodos pueden variar no va resultar en errores ya que se la clase tiene esta diseñada para manejar los desbordes ademas de los años bisiestos

