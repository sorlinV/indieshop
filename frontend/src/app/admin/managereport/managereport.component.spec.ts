import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ManagereportComponent } from './managereport.component';

describe('ManagereportComponent', () => {
  let component: ManagereportComponent;
  let fixture: ComponentFixture<ManagereportComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ManagereportComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ManagereportComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
