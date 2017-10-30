import { Component, OnInit } from '@angular/core';
import { SessionService } from '../Services/session.service';
import { UserService } from '../Services/user.service';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {
  private errorMessage:string = "";
  private form;
    constructor(private userService:UserService, private session:SessionService) { }
  
    ngOnInit() {
      this.form = {
        username: "",
        password: "",
        password2: "",
        mail: ""
      }
    }
    
    register() {
      if (this.form.password === this.form.password2) {
        this.userService.registerUser(this.form.username, this.form.mail, this.form.password)
        .then((user)=>{
          console.log(user);
          this.session.login(user);
        });
      } else {
        this.errorMessage = "Les mots de passe ne sont pas les même.";
      }
    }  
}