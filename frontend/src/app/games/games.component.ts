import { Component, OnInit } from '@angular/core';
import { GameService } from '../Services/game.service';
import { SessionService } from '../Services/session.service';
import { RateService } from '../Services/rate.service';

@Component({
  selector: 'app-games',
  templateUrl: './games.component.html',
  styleUrls: ['./games.component.css']
})

export class GamesComponent implements OnInit {
  private games;
  private game_select;
  constructor(private game:GameService, public session:SessionService,
    private rateService:RateService) { }

  ngOnInit() {
    this.game.getAllGame().then((games)=>{
      this.games = games;
      this.game_select = this.games[0];
    }).catch(error => console.error(error));
  }
}
