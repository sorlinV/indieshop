import { Component, OnInit } from '@angular/core';
import { SessionService } from '../Services/session.service';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {
  private errorMessage:string = "";
  private form;
  constructor(private session:SessionService) { }

  ngOnInit() {
    this.form = {
      username: "",
      password: "",
      password2: "",
      mail: ""
    }
  }

  login() {
    if (this.form.password === this.form.password2) {
      this.session.register(this.form.username, this.form.password, this.form.mail);      
    } else {
      this.errorMessage = "Les mots de passe ne sont pas les même.";
    }
  }
}