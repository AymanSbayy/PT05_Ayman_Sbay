1. Per recuperar la contrasenya, he hagut de crear una nova vista i un nou model per poder tractar-ho tot. El que faig és generar un token, el qual guardem 
a la base de dades en el moment que l'usuari introdueix el correu electrònic en el qual vol rebre l'enllaç de recuperació, i en aquest mateix enllaç que 
enviem també l'enviem amb el token, per després poder accedir a la base de dades i buscar on està el token, ja que en cas que canviïn la contrasenya, podrem
saber quin usuari és i on fer la modificació.


2. En el captcha sincerament m'he complicat bastant, el procés era senzill, però per fer que el captcha aparegués després de 3 intents fallits de login, he 
creat una cookie que és com un comptador, el qual va incrementant cada vegada que la variable errors no estigui buida. Un cop arriba a 3 errors el que he fet
és crear una altra vista de login idèntica a la que ja tinc però afegint-li el captcha ja que aquest va sí o sí en l'HTML, i al no saber com fer-ho al principi
ho vaig fer de la forma fàcil.


3. En l'autenticació social només he fet servir l'OAuth. En aquest cas crec que també m'he complicat les coses més del que havia de fer. Primer amb el composer
he instal·lat totes les llibreries necessàries. Després, he creat 4 fitxers perquè fessin el procés de demanar la informació a la xarxa social a la qual estiguem
accedint ("autentificacio.php" "configuracio.php" "regautentificacio.php" "regconfiguracio.php"). He creat tants fitxers perquè uns identificaven si s'estava
logant i altres si s'estava registrant per primera vegada. El meu problema principal i la raó per la qual ho he fet així és perquè jo treballo des del principi
amb el DNI de l'usuari com a clau única, llavors sí o sí, si estem en un registre per primera vegada em fa falta que l'usuari introdueixi el seu DNI, per això
he creat una altra vista i un altre controlador que tractin això.
