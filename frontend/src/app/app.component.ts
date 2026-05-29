import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { Task } from './models/task';
import { TaskService } from './services/task.service';

@Component({
  selector: 'app-root',
  imports: [CommonModule],
  templateUrl: './app.component.html',
  styleUrl: './app.component.css',
})
export class AppComponent implements OnInit {
  tasks: Task[] = [];
  error = '';

  constructor(private taskService: TaskService) {}

  ngOnInit(): void {
    this.taskService.getTasks().subscribe({
      next: (tasks) => (this.tasks = tasks),
      error: () => (this.error = 'Could not load tasks'),
    });
  }
}
