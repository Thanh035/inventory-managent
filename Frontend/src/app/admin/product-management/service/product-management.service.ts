import { HttpClient, HttpResponse } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { forkJoin, Observable, switchMap } from 'rxjs';
import { ApplicationConfigService } from 'src/app/core/config/application-config.service';
import { ProductDTO, ProductDetailDTO, ProductRequestDTO, SalesProductDTO } from '../product-management.model';
import { Pagination } from 'src/app/core/request/request.model';
import { createFormData, createHttpOptions, createRequestOption } from 'src/app/core/request/request-util';

@Injectable({
  providedIn: 'root'
})
export class ProductManagementService {
  private resourceUrl = this.applicationConfigService.getEndpointFor('api/admin/products');

  constructor(private http: HttpClient, private applicationConfigService: ApplicationConfigService) { }

  create(newProduct: ProductRequestDTO): Observable<ProductDTO> {
    return this.http.post<ProductDTO>(this.resourceUrl, newProduct);
  }

  update(product: ProductRequestDTO,productId:number): Observable<ProductDTO> {
    return this.http.put<ProductDTO>(`${this.resourceUrl}/${productId}`, product);
  }

  find(id: number): Observable<ProductDetailDTO> {
    return this.http.get<ProductDetailDTO>(`${this.resourceUrl}/${id}`);
  }

  query(req?: Pagination): Observable<HttpResponse<ProductDTO[]>> {
    const options = createRequestOption(req);
    return this.http.get<ProductDTO[]>(this.resourceUrl, { params: options, observe: 'response' });
  }

  deleteProduct(id: number): Observable<{}> {
    return this.http.delete(`${this.resourceUrl}/${id}`);
  }

  deleteProducts(ids: number[]): Observable<{}> {
    const options = createHttpOptions(ids);
    return this.http.delete(this.resourceUrl, options);
  }

  categories(): Observable<string[]> {
    return this.http.get<string[]>(this.applicationConfigService.getEndpointFor('api/categories'));
  }

  suppliers(): Observable<string[]> {
    return this.http.get<string[]>(this.applicationConfigService.getEndpointFor('api/suppliers'));
  }

  products(): Observable<SalesProductDTO[]>{
    return this.http.get<SalesProductDTO[]>(this.applicationConfigService.getEndpointFor('api/products'));
  }

  getProductsAvailable(): Observable<SalesProductDTO[]>{
    return this.http.get<SalesProductDTO[]>(this.applicationConfigService.getEndpointFor('api/products/available'));
  }

  upload(productId: number,file: File): Observable<{}> {
    const formData = createFormData(file);
    return this.http.post(`${this.resourceUrl}/${productId}/product-image`,formData);
  }

  getProductImage(productId: number): Observable<string> {
    return this.http.get<string>(`${this.resourceUrl}/${productId}/product-image`);
  }

  // load(productId:number): Observable < Blob > {
  //   return this.http.get(`${this.resourceUrl}/${productId}/product-image`, {
  //    responseType: "blob"
  //   });
  //  }

  load(productId: number): Observable<Blob[]> {
    return this.http.get<string[]>(`${this.resourceUrl}/${productId}/product-image`) // Gọi API lấy danh sách URL ảnh
      .pipe(
        switchMap(urls => forkJoin( // Chờ tất cả các ảnh được tải về
          urls.map(url =>
            this.http.get(url, { responseType: 'blob' }) // Chuyển từng URL ảnh thành Blob
          )
        ))
      );
  }

}
