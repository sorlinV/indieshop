import { Component, OnInit } from '@angular/core';
import { GameService } from '../Services/game.service';
import { SessionService } from '../Services/session.service';

@Component({
  selector: 'app-acceuil',
  templateUrl: './acceuil.component.html',
  styleUrls: ['./acceuil.component.css']
})
export class AcceuilComponent implements OnInit {
  private games;
  constructor(private game:GameService, private session:SessionService) { }

  ngOnInit() {
    this.game.getAllGame(this.session.getSession().token).then((games)=>{
      console.log(games);
      this.games = games;
    });
  }
}
