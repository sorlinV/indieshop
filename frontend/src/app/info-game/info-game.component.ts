import { Component, OnInit, Input } from '@angular/core';
import { SessionService } from '../Services/session.service';
import { GameService } from '../Services/game.service';
import { ActivatedRoute } from '@angular/router';
import { UserService } from '../Services/user.service';
import { Game } from '../Classes/Game';
import { RateService } from '../Services/rate.service';

@Component({
  selector: 'app-info-game',
  templateUrl: './info-game.component.html',
  styleUrls: ['./info-game.component.css']
})
export class InfoGameComponent implements OnInit {
  private _game;
  @Input()
  set game(game:Game) {
    this._game = game || '<no game set>';
  }
  constructor(private route:ActivatedRoute, private session:SessionService,
  private gameService:GameService, private userService:UserService,
  private rateService:RateService) {}

  ngOnInit() {
  }

  public rate(game_id, rate){
    this.rateService.addRate(this.session.getSession().token, game_id, rate)
    .then(($message)=>{
      this.ngOnInit();
    }).catch(error => console.error(error));
  }

  public unRate(rate_id){
    this.rateService.removeRate(rate_id, this.session.getSession().token)
    .then((message)=>{console.log(message)}).catch(error => console.error(error));
  }

  public editRate(rate_id, game_id, rate){
    this.rateService.removeRate(rate_id, this.session.getSession().token)
    .then(($message)=>{
      this.rateService.addRate(this.session.getSession().token, game_id, rate)
      .then(($message)=>{
        this.ngOnInit();
      }).catch(error => console.error(error));;
    }).catch(error => console.error(error));
  }

  getRate(game, username) {
    if (game.rates !== undefined)
    {
      for (let rate of game.rates) {
        if (rate.user.username === username) {
          return rate;
        }
      }
    }
    return false;
  }

  moyRate(game) {
    if (game === undefined || game.rates === undefined || game.rates.length === 0) {
      return 0;
    }
    let total = 0;
    for (let rate of game.rates) {
      total += rate.rate;
    }
    return total / game.rates.length;
  }
}
