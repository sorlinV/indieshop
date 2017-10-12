import { Routes } from "@angular/router"
import { AcceuilComponent } from "./acceuil/acceuil.component";
import { NotfoundComponent } from "./notfound/notfound.component";

export const appRoutes:Routes = [
    {path: '', pathMatch: 'full', component: AcceuilComponent},
    {path: '**', component: NotfoundComponent}
]