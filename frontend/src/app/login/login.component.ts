import { Component } from "@angular/core";
import { UserService } from "../users/users.service";

@Component({
  selector: "app-login",
  templateUrl: "./login.component.html",
  styleUrls: ["./login.component.css"]
})
export class LoginComponent {
  username: string | undefined;
  password: string | undefined;

  constructor(public userService: UserService) {}

  login() {
    const user = {username: this.username, password: this.password};
    this.userService.login(user).subscribe(data => {
      console.log(data);
      localStorage.setItem("token",data.token);
    },
    error=>{
      console.log(error);
      alert("User no logon");
    });
  }
}