import { Component, OnInit } from '@angular/core';
import { User } from '../Classes/User';
import { ActivatedRoute } from '@angular/router';
import { UserService } from '../Services/user.service';
import { SessionService } from '../Services/session.service';

@Component({
  selector: 'app-profil',
  templateUrl: './profil.component.html',
  styleUrls: ['./profil.component.css']
})
export class ProfilComponent implements OnInit {
  private is_editing:boolean = false;
  private user;
  private form;
  constructor(private route:ActivatedRoute, private userService:UserService, private session:SessionService) { }

  getUser() {
    this.route.params.subscribe((params) => {
      this.userService.getUser(params.username).then((user)=>{
        this.user = user;
        this.form = {
          username: this.user.username,
          pass: "",
          pass2: "",
          mail: this.user.mail
        };
      });
    });
  }

  ngOnInit() {
    this.getUser();
  }

  update() {
    this.is_editing = false;
    if (this.form.pass === this.form.pass2 &&
      this.form.pass !== "" &&
      this.form.pass2 !== "") {
        this.route.params.subscribe((params) => {
          this.userService.editUser(this.session.getSession().token, params.username, this.form.username, this.form.mail, this.form.pass)
        .then(this.getUser);
      });  
    }
  }

  remove() {
    this.route.params.subscribe((params) => {
      this.userService.removeUser(params.id, this.session.getSession().token);
    });
  }
}