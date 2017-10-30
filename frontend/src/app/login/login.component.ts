import { Component, OnInit } from '@angular/core';
import { UserService } from '../Services/user.service';
import { SessionService } from '../Services/session.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
  private form;
  constructor(private userService:UserService, private session:SessionService) { }

  ngOnInit() {
    this.form = {
      username: "",
      password: ""
    }
  }

  login() {
    this.userService.loginUser(this.form.username, this.form.password)
    .then((user)=>{this.session.login(user)});
  }
}
