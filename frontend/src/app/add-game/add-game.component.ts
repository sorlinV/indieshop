import { Component, OnInit } from '@angular/core';
import { GameService } from '../Services/game.service';
import { SessionService } from '../Services/session.service';

@Component({
  selector: 'app-add-game',
  templateUrl: './add-game.component.html',
  styleUrls: ['./add-game.component.css']
})
export class AddGameComponent implements OnInit {
  private form;
  private error:string;
  private confirm:string;
  constructor(private gameService:GameService, private session:SessionService) {
    this.form = {
      name: "",
      desc: "",
      price: "",
      form: ""
    }
  }

  ngOnInit() {
    
  }

  addGame()
  {
    if (this.session.getSession() !== null)
    {
      console.log(this.form);
      this.gameService.addGame(this.session.getSession().token, this.form.name,
        this.form.desc,
        this.form.price,
        this.form.tags)
      .then((message)=>{
        this.confirm = message.message;
        this.error = "";
      }).catch((message)=>{
        this.error = message.message;
      });
    } else {
      this.error = "you need to be connect";
    }
  }
}
