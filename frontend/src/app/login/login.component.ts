import { Component } from "@angular/core";
import { UserService } from "../users/users.service";
import { ActivatedRoute, Router } from '@angular/router';
@Component({
  selector: "app-login",
  templateUrl: "./login.component.html",
  styleUrls: ["./login.component.css"]
})
export class LoginComponent {
  username: string | undefined;
  password: string | undefined;

  constructor(public userService: UserService, public router : Router, public route:ActivatedRoute) {}

  login() {
    const user = {username: this.username, password: this.password};
    this.userService.login(user).subscribe(data => {
      console.log(data);
      localStorage.setItem("token",data.token);
      this.router.navigate(['']);
    },
    error=>{
      console.log(error);
      alert("User no logon");
    });
  }
  loginCheck(){
    this.userService.getUser().subscribe(data=>{
      alert("Claro que sí mi querido "+data.username);
    },error=>{
      alert("Ni de coña mamón "+error);
    })
  }
}