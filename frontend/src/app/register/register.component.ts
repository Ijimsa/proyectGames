import { Component } from '@angular/core';
import { UserService } from '../users/users.service';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent {
    username:string | undefined; 
    password: string | undefined; 
    confirmPassword: string | undefined; 

    constructor(public userService : UserService) {}

    register() {
        //**Esta funcion hace una llamada a la api y manda los valores del formulario para que se añadan a la BD */
        // Para hacer esto bien, tendría que haber un servicio que validase la información del formulario
        let data = {
          username: this.username,
          password: this.password
        }
        this.userService.register(JSON.stringify(data)).subscribe(data => {
          alert(data);
        })
    }

  }
