import { Injectable } from "@angular/core";
import { HttpClient } from "@angular/common/http";
import { Observable } from "rxjs";

@Injectable({
    providedIn: "root"
})
export class UserService {
    constructor(private http: HttpClient) {}


    login(user: any): Observable<any> {
        // const header = {'Authorization':`Bearer ${token}`} ,{headers:header}
        return this.http.post("http://localhost:8000/api/login_check", user); 
    }

}