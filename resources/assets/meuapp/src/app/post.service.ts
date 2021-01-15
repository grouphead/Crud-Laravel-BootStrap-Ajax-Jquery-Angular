import { HttpClient, HttpEventType } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Post } from './post';

@Injectable({
  providedIn: 'root'
})
export class PostService {

  public posts: Post[] = [];

  constructor(public http: HttpClient) { 
    this.http.get('/api/admin/crudlinguagens').subscribe(
      (posts: any[]) => {
        for(let p of posts){
          this.posts.push(
            new Post(p.nome, p.id)
          )
        }
      }
    );
  }

  salvar(post: Post){
    const uploadData = new FormData();
    uploadData.append('nome', post.nome);

    this.http.post('/api/admin/crudlinguagens', uploadData).subscribe((event: any) =>{
        if (event.type == HttpEventType.Response) {
          console.log(event);
        }
    })
  }

}
