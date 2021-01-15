import { Component, OnInit } from '@angular/core';
import {  MatDialogRef } from '@angular/material/dialog';
import { MatInput } from '@angular/material/input';
import { Post } from '../post';

@Component({
  selector: 'app-post',
  templateUrl: './post.component.html',
  styleUrls: ['./post.component.css']
})
export class PostComponent implements OnInit {

  public dados = {
    post: new Post("")
  };

  constructor(public dialogRef: MatDialogRef<PostComponent>) { }

  ngOnInit(): void {
  }

  salvar(){
    this.dialogRef.close(this.dados)
  }

  cancelar(){
    this.dialogRef.close(null)
  }
}
