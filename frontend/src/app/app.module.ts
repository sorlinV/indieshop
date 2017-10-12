import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppComponent } from './app.component';
import { AcceuilComponent } from './acceuil/acceuil.component';
import { SearchComponent } from './search/search.component';
import { GamesComponent } from './games/games.component';
import { ProfilComponent } from './profil/profil.component';
import { RouterModule } from '@angular/router';
import { appRoutes } from './app.routes';
import { NotfoundComponent } from './notfound/notfound.component';
import { HeaderComponent } from './header/header.component';

@NgModule({
  declarations: [
    AppComponent,
    AcceuilComponent,
    SearchComponent,
    GamesComponent,
    ProfilComponent,
    NotfoundComponent,
    HeaderComponent
  ],
  imports: [
    BrowserModule,
    RouterModule.forRoot(appRoutes)
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
