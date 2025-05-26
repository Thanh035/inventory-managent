import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root',
})
export class ApplicationConfigService {
  private endpointPrefix = 'http://127.0.0.1:8000/';

  // setEndpointPrefix(endpointPrefix: string): void {
  //   this.endpointPrefix = endpointPrefix;
  // }

  getEndpointFor(api: string): string {
    return `${this.endpointPrefix}${api}`;
  }
}
