import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class UserService {
  constructor(private http: HttpClient) {}
  getHeaderForApi() {
    const token = localStorage.getItem('token');
    return { Authorization: `Bearer ${token}` };
  }

  login(user: any): Observable<any> {
    return this.http.post('http://localhost:8000/api/login_check', user);
  }
  register(data: any): Observable<any> {
    return this.http.post('http://localhost:8000/api/register', data);
  }
  getUser(): Observable<any> {
    const header = this.getHeaderForApi();
    console.log(header);
    return this.http.post('http://localhost:8000/api/getUser', null, {
      headers: header,
    });
  }
  logout(){
    localStorage.setItem('token', '');
  }
}
