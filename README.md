# Aritmetica con Fechas
Es un una libreria pequeña que permite el manejo de fechas de forma facil

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
```
- El orden en que se aplique los metodos pueden variar no va resultar en errores ya que se la clase tiene esta diseñada para manejar los desbordes ademas de los años bisiestos

