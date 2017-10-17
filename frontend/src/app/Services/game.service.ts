import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { GenericService } from "./generic.service";
import { Game } from "../Classes/Game";


@Injectable()
export class GameService extends GenericService<Game> {
    protected urlAPI:string = 'http://localhost:3000/game';
}