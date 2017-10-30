import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ManagegamesComponent } from './managegames.component';

describe('ManagegamesComponent', () => {
  let component: ManagegamesComponent;
  let fixture: ComponentFixture<ManagegamesComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ManagegamesComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ManagegamesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
