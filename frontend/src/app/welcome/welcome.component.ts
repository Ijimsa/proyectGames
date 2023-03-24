import { Component } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { UserModule } from '../shared/user.module';
import { UserService } from '../users/users.service';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-welcome',
  templateUrl: './welcome.component.html',
  styleUrls: ['./welcome.component.css']
})
export class WelcomeComponent {
  user: any = false;
  ngOnInit():void{
    this.userService.getUser().subscribe(data=>{
      this.user=data.username
    },error =>{
      this.user=false;
    })
  }
  logout():void{
    this.userService.logout();
    this.ngOnInit();
  }
  constructor(private route:ActivatedRoute,
    private router: Router, public userService : UserService, public common : CommonModule){}
}
