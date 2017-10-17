import { Component, OnInit } from '@angular/core';
import { SessionService } from '../Services/session.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
  private form;
  constructor(private session:SessionService) { }

  ngOnInit() {
    this.form = {
      username: "",
      password: ""
    }
  }

  login() {
    this.session.login(this.form.username, this.form.password);
  }
}
