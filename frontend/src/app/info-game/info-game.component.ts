import { Component, OnInit } from '@angular/core';
import { SessionService } from '../Services/session.service';
import { GameService } from '../Services/game.service';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-info-game',
  templateUrl: './info-game.component.html',
  styleUrls: ['./info-game.component.css']
})
export class InfoGameComponent implements OnInit {

  constructor(private route:ActivatedRoute, private session:SessionService, private gameSession:GameService) {}

  ngOnInit() {
  }

  getGame()
  {
    this.route.params.subscribe((params) => {
      this.gameSession.getGame(params.id)
      .then((game)=>{
        console.log(game);
      })
    });
  }
}
