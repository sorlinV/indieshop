import { Routes } from "@angular/router"
import { AcceuilComponent } from "./acceuil/acceuil.component";
import { NotfoundComponent } from "./notfound/notfound.component";
import { GamesComponent } from "./games/games.component";
import { ProfilComponent } from "./profil/profil.component";

export const appRoutes:Routes = [
    {path: 'games', component: GamesComponent},
    {path: 'profil/:id', component: ProfilComponent},
    {path: 'store', component: AcceuilComponent},
    {path: '', pathMatch: 'full', component: AcceuilComponent},
    {path: '**', component: NotfoundComponent}
]