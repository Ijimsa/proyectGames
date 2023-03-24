# proyectGames
Angular and symfony
Api para registrarte : localhost:8000/register
Importante tener lanzado el servidor de symfony symfony server:start 
Mandar las solicitudes por POST

Verás que dentro de la funcion login en la promesa, hay una cosa que se llama header, eso hay que mandarlo siempre por post ya que deberá de contener el token
Además el token se guarda cuando el registro es exitoso en un localStorage, que es básicamente una cookie, simplemente para acceder a ella pones localStorage.getItem("user") y ya obtienes el token de usuario.
