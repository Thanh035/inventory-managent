import {
  Component,
  ViewChild,
  OnInit,
  AfterViewInit,
  ElementRef,
} from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { Router } from '@angular/router';

import { LoginService } from 'src/app/login/login.service';
import { AccountService } from '../core/auth/account.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
})
export class LoginComponent implements OnInit, AfterViewInit {
  @ViewChild('username', { static: false })
  username!: ElementRef;

  authenticationError = false;

  loginForm = new FormGroup({
    email: new FormControl('', {
      nonNullable: true,
      validators: [Validators.required],
    }),
    password: new FormControl('', {
      nonNullable: true,
      validators: [Validators.required],
    })
    // rememberMe: new FormControl(false, {
    //   nonNullable: true,
    //   validators: [Validators.required],
    // }),
  });

  constructor(
    private accountService: AccountService,
    private loginService: LoginService,
    private router: Router
  ) {}

  ngOnInit(): void {
    // if already authenticated then navigate to home page
    this.accountService.identity().subscribe(() => {
      if (this.accountService.isAuthenticated()) {
        this.router.navigate(['/admin']);
      }
    });
  }

  ngAfterViewInit(): void {
    this.username.nativeElement.focus();
  }

  login(): void {
    this.loginService.login(this.loginForm.getRawValue()).subscribe({
      next: () => {
        this.authenticationError = false;
        if (!this.router.getCurrentNavigation()) {
          // There were no routing during login (eg from navigationToStoredUrl)
          // this.router.navigate(['/admin']);
          window.location.href = "/admin";
        }
      },
      error: () => (this.authenticationError = true),
    });
  }
}
