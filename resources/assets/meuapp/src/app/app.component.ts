import { Component } from '@angular/core';
import { MatDialog } from '@angular/material/dialog';
import { Post } from './post';
import { PostService } from './post.service';
import { PostComponent } from './post/post.component';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'meuapp';
  public posts: Post[] = [];

  constructor(
    public dialog: MatDialog,
    public postService: PostService
    ){}



  ngOnInit(){
    this.posts = this.postService.posts;
  }

  openDialog(){
    const dialogRef = this.dialog.open(PostComponent, {
      width: '500px'
    });
    dialogRef.afterClosed().subscribe(
      (result) => {
        if (result) {
          this.postService.salvar(result.post)
        }
      }
    );
  }
}
